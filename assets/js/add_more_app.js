  const addFormDeleteLink = (item, deleteItem) => {
    const removeFormIcon = document.createElement('i');
    console.log(removeFormIcon);
    removeFormIcon.innerText = 'close';
    removeFormIcon.classList.add('material-icons', 'icon', 'redicon');

    item.append(removeFormIcon);

    removeFormIcon.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        deleteItem.remove();
    });
  }

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
      addFormDeleteLink(item.children[0].children[0], item.children[0]);
      addApplicationLink(item);
      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
          })
  });


  const addApplicationLink = (app) => {
    console.log("bonjour");

app
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", (e) => {
        const collectionHolder = app.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

      const item = document.createElement('li');

      item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
          /__name__/g,
          collectionHolder.dataset.index
        );
      addFormDeleteLink(item, item);
      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
          })
  });
  }

  Array.prototype.slice.call(document.querySelector('.machine').children).forEach(item => {
  addFormDeleteLink(item, item);
});

  Array.prototype.slice.call(document.querySelector('.application').children).forEach(item => {
  addFormDeleteLink(item, item);
});
