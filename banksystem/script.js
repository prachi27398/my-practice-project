class BankAccount{

    constructor(accountNumber, accountHolder, balance = 0) {
        this.accountNumber = accountNumber;
        this.accountHolder = accountHolder;
        this.balance = balance;
    }

    deposit(amount){
       this.balance += amount;
        console.log(`$${amount} is deposit and Now Your Balance is $${this.balance}.`);
    }

    withdraw(amount){
        if(this.balance < amount)
        {
            console.log('Insufficient Balance');
        }else{
            this.balance -= amount;
            console.log(`$${amount} is withdrawn and Now Your Balance is $${this.balance}.`);
        }

        
    }

    checkBalance()
    {
        console.log(`Account balance for $${this.accountHolder}: $${this.balance}`);
        
    }
}


export default BankAccount;