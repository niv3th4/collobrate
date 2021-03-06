// Generated by CoffeeScript 1.7.1
(function() {
  var app, loginCtrl,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  app = angular.module('Pyoopil.Controllers');

  loginCtrl = (function(_super) {
    __extends(loginCtrl, _super);

    function loginCtrl() {
      this.submit = __bind(this.submit, this);
      return loginCtrl.__super__.constructor.apply(this, arguments);
    }

    loginCtrl.register(app);

    loginCtrl.inject('$scope', 'Auth', 'Notify', 'UserService', '$state', 'Utilities');

    loginCtrl.prototype.initialize = function() {
      this.$scope.login = {};
      return this.$scope.submit = this.submit;
    };

    loginCtrl.prototype.submit = function(form) {
      var data, promise;
      if (form.email.$invalid) {
        this.Notify.alert('Please enter a valid email', 'error');
        return;
      }
      if (form.password.$invalid) {
        this.Notify.alert('Please enter a valid password', 'error');
        return;
      }
      if (form.$valid) {
        data = {
          "AppUser": {
            "email": this.$scope.login.email,
            "password": this.$scope.login.password
          }
        };
      }
      promise = this.UserService.login(data);
      return promise.then((function(_this) {
        return function(data) {
          _this.Utilities.closeModal();
          return _this.$state.transitionTo('Views.Classrooms');
        };
      })(this));
    };

    return loginCtrl;

  })(BaseCtrl);

}).call(this);

//# sourceMappingURL=loginCtrl.map
