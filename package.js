Package.describe({
  name: 'joypixels:emoji-toolkit',
  summary: 'Meteor Package of the https://www.joypixels.com/ set.',
  version: '6.0.1',
  git: 'https://github.com/joypixels/emoji-toolkit.git'
});

Package.onUse(function(api) {
  api.versionsFrom('1.0.2.1');

  api.addFiles([
    'lib/meteor/pre-export.js',
    'lib/js/joypixels.js',
    'lib/meteor/post-export.js'
  ]);

  api.use([
    'blaze',
    'htmljs',
    'templating'
  ], 'client');

  api.addFiles([
    'lib/meteor/joypixels-client.js',
    'extras/css/joypixels.css',
    'extras/css/joypixels-awesome.css'
  ], 'client');
  
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32.min.css', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-activity.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-diversity.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-flags.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-food.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-nature.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-objects.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-people.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-regional.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-symbols.png', 'client');
  api.addAssets('../emoji-assets/sprites/joypixels-sprite-32-travel.png', 'client');

  api.export('joypixels');
});
