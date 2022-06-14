// add-collection-widget.js
/*
const jQuery = require('jquery');
jQuery(document).ready(function () 
{
    jQuery('.add-another-collection-widget').click(function (e) 
    {
        var list = jQuery(jQuery(this).attr('data-list-selector'));
        // Try to find the counter of the list or use the length of the list
        var counter = list.data('widget-counter') || list.children().length;

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter', counter);

        // create a new list element and add it to the list
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    });

    const addContactFormDeleteLink = (item) => {
        const removeFormButton = document.createElement('button');
        removeFormButton.innerText = 'Delete this tag';

        item.append(removeFormButton);

        removeFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            // remove the li for the tag form
            item.remove();
            });
    }    
    
});
*/
console.log(document.querySelectorAll('.add_item_link'))
document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", (e) => {
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
          })
  });

  const addContactFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Delete this tag';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}