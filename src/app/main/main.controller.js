(function() {
  'use strict';

  angular
    .module('toomanydonkeys')
    .controller('MainController', MainController);

  /** @ngInject */
  function MainController($http) {

    var vm = this;

    var data = $http.get('assets/ep_list.json');
        data.then(function(data){
          vm.episodes = data.data;
        });

    vm.getRandom = function(){
      
    }
  }
})();
