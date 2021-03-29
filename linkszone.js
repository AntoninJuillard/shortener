const accountZone = document.querySelector('.account_zone')
const accountContainer = accountZone.querySelector('.account_container')
const homeContainer = document.querySelector('.home_container')
const accountButton = homeContainer.querySelector('.account-button')
const homeForm = homeContainer.querySelector('.home_form')
const newLinkButton = homeContainer.querySelector('.newlink-button')

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
        homeForm.classList.add('home_form_moove')
        accountButton.textContent = "deconnexion"
        accountButtonChange = true
        console.log(accountButtonChange);
    }
})

newLinkButton.addEventListener('click', () => 
{
    window.location.href="createlink.php" 
})
