const accountZone = document.querySelector('.account_zone')
const accountContainer = accountZone.querySelector('.account_container')
const homeContainer = document.querySelector('.home_container_createlink')
const accountButton = homeContainer.querySelector('.account-button')
const homeForm = homeContainer.querySelector('.home_form')

const closeContainerButton = accountContainer.querySelector('.account_container_close-button')
// Si le bouton est en mode ouvrir la partie mon compte
// ou en mode se déconnecter 
let accountButtonChange = false


// fonction pour ouvrir la partie stats "mon compte"
// & pour se déconnecter et changer le bouton 
accountButton.addEventListener('click',() => 
{
    if(accountButtonChange === true) 
    {
        window.location.href="connection.php" 
        console.log(accountButtonChange);
    } else {
        accountContainer.classList.add('account_container_reveal')
        accountContainer.classList.remove('account_container_close')
        homeForm.classList.remove('home_form_mooveback')
        homeForm.classList.add('home_form_moove')
        accountButton.textContent = "log out"
        accountButtonChange = true
        console.log(accountButtonChange);
    }
})

closeContainerButton.addEventListener('click', () => 
{
    accountContainer.classList.remove('account_container_reveal')
    accountContainer.classList.add('account_container_close')
    accountButton.textContent = 'MY ACCOUNT'
    homeForm.classList.remove('home_form_moove')
    homeForm.classList.add('home_form_mooveback')
    accountButtonChange = false
})