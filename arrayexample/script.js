let array = [];

function addArray(type){
    const newarrayValue = document.getElementById('array_input').value.trim();
    if(newarrayValue !== '')
    {
        
        switch(type){
            case 'first':
                array.unshift(newarrayValue);   // Add element in array last
                break;
            
            case 'last':
                array.push(newarrayValue);  // Add element in array first
                break;

            default:
                ('Invalid Operation.');
        }
        
        displayArray();

    }else{
        alert('Please Enter a Valid Element.');
    }
  
}

function displayArray(){
    const arrayContainer = document.getElementById('array_list');
    arrayContainer.innerHTML = '';    // clear previous content

    array.forEach((element,index) => {
        const elementdiv = document.createElement('div');
        elementdiv.textContent = `Element ${index + 1}: ${element}`;
        arrayContainer.appendChild(elementdiv);
    });
}

function removeArray(type){

    if(array.length === 0){
        alert('Array is empty.');
        return;
    }

    switch(type) {
        case 'first':
            array.shift();     // Remove first element from Array 
            break;
        
        case 'last':
            array.pop();    // Remove last element from array
            break;

        default:
            alert('Invalid operation.');
    }

    displayArray();
}

// array.splice(index, 1)              //remove particular index Element from array 