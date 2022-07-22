const addContactFormDeleteLink = (item) => {
    console.log(item)
    const removeFormIcon = document.createElement('i');
    removeFormIcon.innerText = 'close';
    removeFormIcon.classList.add('material-icons', 'form-delete');

    item.prepend(removeFormIcon);

    removeFormIcon.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}

$(document).ready(function () {
    let checkbox = $('#customer_haveBillingAddress');
    let billingAddressForm = $('.billingAddressForm');
    checkbox.click(function () {
        if (checkbox.is(':checked')){
            billingAddressForm.css("height", "auto");
            billingAddressForm.css("visibility", "visible");
            billingAddressForm.css("opacity", "1");
        }else {
            billingAddressForm.css("height", "0");
            billingAddressForm.css("visibility", "hidden");
            billingAddressForm.css("opacity", "0");
        }
    });

    $('#add_contact_btn').click((e) => {
        console.log(e.currentTarget.dataset)
        const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        const item = document.createElement('li');

        item.innerHTML = collectionHolder
            .dataset
            .prototype
            .replace(
              /__name__/g,
              collectionHolder.dataset.index
            );
        addContactFormDeleteLink(item);
        collectionHolder.appendChild(item);

        collectionHolder.dataset.index++;
    });

    $('.contacts').children().each((key, contact) => {
        addContactFormDeleteLink(contact);
    })

});
