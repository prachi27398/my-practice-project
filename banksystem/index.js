// mdn document usefull document for javascript event 

import BankAccount from "./script.js";

const account1 = new BankAccount(123456,'Prachi Patel',1000);
const account2 = new BankAccount(456789,'Akash Barot',5000);

account1.deposit(4000);
account2.deposit(500);

account1.withdraw(500);
account2.withdraw(100);

account1.checkBalance();
account2.checkBalance();

document.addEventListener('DOMContentLoaded',addElement);

function addElement(){
    // create new section
    const newSection = document.createElement('section');

    // add new class in that created section
    newSection.classList.add('chapter-section');

    // create new paragraph
    const newParagraph = document.createElement('p');

    // create text for paragraph
    const newContent = document.createTextNode("Hi,Prachi I am Good. How's going on?");

    //Append content in paragraph 
    newParagraph.appendChild(newContent);

    newSection.appendChild(newParagraph);

    const existingSection = document.querySelector('section.paragraph-section');

    existingSection.insertAdjacentElement("afterend",newSection);
}