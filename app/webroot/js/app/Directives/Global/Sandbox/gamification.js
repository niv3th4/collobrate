// Generated by CoffeeScript 1.7.1
(function () {
  var __bind = function (fn, me) {
      return function () {
        return fn.apply(me, arguments);
      };
    },
    __hasProp = {}.hasOwnProperty,
    __extends = function (child, parent) {
      for (var key in parent) {
        if (__hasProp.call(parent, key)) child[key] = parent[key];
      }

      function ctor() {
        this.constructor = child;
      }
      ctor.prototype = parent.prototype;
      child.prototype = new ctor();
      child.__super__ = parent.prototype;
      return child;
    };

  angular.module('Pyoopil.Directives').directive('gamification', [
    'EventEmitter', 'Notify',
    function (EventEmitter, Notify) {
      return {
        restrict: 'E',
        templateUrl: '/pyoopil/js/app/partials/sandbox/gamification.html',
        link: function (scope, elem, attrs) {
          var Gamification;
          return new(Gamification = (function (_super) {
            __extends(Gamification, _super);

            function Gamification() {
              this.handlePraise = __bind(this.handlePraise, this);
              this.$praises = elem.find('.clk-tt');
              this.type = attrs.type;
              if (this.type === 'Discussion') {
                this.data = scope.discussion[this.type];
                scope.Gamificationvote = scope.discussion.Gamificationvote;
              } else {
                this.data = scope.reply;
                scope.Gamificationvote = scope.reply.Gamificationvote;
              }
              scope.canPraise = !this.data.showGamification;
              scope.showPraiseResults = this.data.showGamification;
              scope.showPraise = false;
              scope.handlePraise = this.handlePraise;
              elem.on('click', '.addPraise', (function (_this) {
                return function (e) {
                  scope.showPraise = !scope.showPraise;
                  if (!scope.$$phase) {
                    return scope.$digest();
                  }
                };
              })(this));
            }

            Gamification.prototype.handlePraise = function (praise) {
              scope.Gamificationvote[praise] += 1;
              scope.canPraise = false;
              scope.showPraiseResults = true;
              scope.showPraise = false;
              return this.broadcast('UPDATE.Praise', {
                "praise": praise,
                "id": this.data.id,
                "type": this.type
              }, scope);
            };

            return Gamification;

          })(EventEmitter));
        }
      };
    }
  ]);

}).call(this);

//# sourceMappingURL=gamification.map