<?php
interface AccountInterface {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;
    protected $balance;
    protected $currency;

    public function __construct($balance, $currency) {
        if ($balance < self::MIN_BALANCE) $balance = self::MIN_BALANCE;
        $this->balance = $balance;
        $this->currency = $currency;
    }

    public function deposit($amount) {
        if ($amount <= 0) throw new Exception("Некоректна сума для поповнення");
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= 0) throw new Exception("Некоректна сума для зняття");
        if ($amount > $this->balance) throw new Exception("Недостатньо коштів");
        $this->balance -= $amount;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }
}

class SavingsAccount extends BankAccount {
    public static $interestRate = 5;

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate / 100;
        $this->balance += $interest;
    }
}

try {
    $acc1 = new BankAccount(1000, "USD");
    $acc1->deposit(500);
    $acc1->withdraw(300);
    echo "Баланс рахунку 1: " . $acc1->getBalance() . " " . $acc1->getCurrency() . "<br>";

    $acc2 = new SavingsAccount(2000, "EUR");
    $acc2->applyInterest();
    echo "Баланс накопичувального рахунку після нарахування відсотків: " . $acc2->getBalance() . " " . $acc2->getCurrency() . "<br>";

    $acc2->withdraw(3000);
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}
?>