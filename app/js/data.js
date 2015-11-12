app.factory("Data", ['$http', '$location',
    function ($http, $q, $location) {
        var serviceBase = '../frontend/web/indomobilecell/';
        var suffix = '.html';
        var photoDir = '../app/';

        var obj = {};
        obj.base = serviceBase;

        obj.get = function (q, object) {
            return $http.get(serviceBase + q + suffix, {
                params: object
            }).then(function (results) {
                return results.data;
            });
        };
        obj.post = function (q, object) {
            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
            return $http.post(serviceBase + q + suffix, object).then(function (results) {
                return results.data;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q + suffix, object).then(function (results) {
                return results.data;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q + suffix).then(function (results) {
                return results.data;
            });
        };
        return obj;
    }]);
