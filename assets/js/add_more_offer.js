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
      addOfferFormDeleteLink(item);
      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
          })
  });

  const addOfferFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Delete this offer';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}