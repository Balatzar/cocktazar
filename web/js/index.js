$('.ui.dropdown').dropdown();

$('.js-search')
  .form({
    fields: {
      ingredients: {
        identifier: 'ingredients',
        rules: [
          {
            type   : 'empty',
            prompt : 'Veuillez entre un ou plus ingrédient'
          }
        ]
      },
    },
  });
