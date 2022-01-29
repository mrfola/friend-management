let editButtons = document.querySelectorAll('#edit-button');
let friendsTable = document.querySelector('.friendsTable');

editButtons.forEach(function(editButton)
{
    editButton.addEventListener('click', function()
    {
        let locatorClass = editButton.getAttribute('locator-class'); //get unique locator class from the button

        //call all inputs and selects with that unique locator class
        let formRow = document.querySelector(`.${locatorClass}`);
        let inputs = formRow.querySelectorAll('input'); 
        let selects = formRow.querySelectorAll('select');
        let updateButton = formRow.querySelector('#update-button')

        //Make the inputs and selects active
        inputs.forEach(function(input)
        {
            if (input.disabled)
            {
                input.disabled = false;
            }
        });

        selects.forEach(function(select)
        {
            if (select.disabled)
            {
                select.disabled = false;
            }
        });

        //hide edit button 
        editButton.style = "display: none";

        //display update button
        updateButton.style = "display: block";

    });
});
   
