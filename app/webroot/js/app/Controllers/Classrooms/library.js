// Generated by CoffeeScript 1.7.1
(function() {
  var app, libraryCtrl,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  app = angular.module('Pyoopil.Controllers');

  libraryCtrl = (function(_super) {
    __extends(libraryCtrl, _super);

    function libraryCtrl() {
      return libraryCtrl.__super__.constructor.apply(this, arguments);
    }

    libraryCtrl.register(app);

    libraryCtrl.inject('$scope', 'libraryService', 'FileUploader');

    libraryCtrl.prototype.initialize = function() {
      this.$scope.pageNo = 1;
      this.$scope.permissions = {};
      this.$scope.isSubmitted = false;
      return this.$scope.uploader = new this.FileUploader({
        filters: [
          {
            name: 'singleUpload',
            fn: function(item, options) {
              return this.queue.length === 0;
            }
          }
        ]
      });
    };

    return libraryCtrl;

  })(BaseCtrl);

}).call(this);

//# sourceMappingURL=library.map
