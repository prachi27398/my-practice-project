function changeMode(){

    let className = 'dark-mode';
    let header = document.querySelector('header');
    let button = document.querySelector('button');

    // toggle class in body header and button.
    document.body.classList.toggle('dark-mode');
    header.classList.toggle('dark-mode');
    button.classList.toggle('dark-mode');

    // Change button Text.
    if(document.body.classList.contains('dark-mode'))
    {
        button.textContent = 'Switch to Light Mode';
    }else{
        button.textContent = 'Switch to Dark Mode';
    }
}