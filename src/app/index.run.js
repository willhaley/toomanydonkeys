(function() {
  'use strict';

  angular
    .module('toomanydonkeys')
    .run(runBlock);

  /** @ngInject */
  function runBlock($log) {

    $log.debug('runBlock end');
  }

})();
