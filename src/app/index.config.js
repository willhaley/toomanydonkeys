(function() {
  'use strict';

  angular
    .module('toomanydonkeys')
    .config(config);

  /** @ngInject */
  function config($logProvider) {
    // Enable log
    $logProvider.debugEnabled(true);
  }

})();
