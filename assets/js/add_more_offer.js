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
      addRamFormDeleteLink(item);
      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
          })
  });

  const addRamFormDeleteLink = (item) => {
    const removeFormIcon = document.createElement('i');
    removeFormIcon.innerText = 'close';
    removeFormIcon.classList.add('material-icons', 'icon', 'redicon');

    item.append(removeFormIcon);

    removeFormIcon.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
  }