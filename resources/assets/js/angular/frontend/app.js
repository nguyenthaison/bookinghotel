angular.module('frontend', [
        'ui.bootstrap',
        'angular-loading-bar',
        'angularLazyImg',
        'infinite-scroll'
    ]).value('url', 'http://www.balihomeparadise.com')
    .value('thumb_path', '/thumb')
    .value('thumb_size', '350');

/*******************************************************************
						Controllers
*******************************************************************/
// Admin Controller
angular.module('frontend').controller('homeController', ['$scope', '$http', '$log', 'url', 'thumb_path', 'thumb_size',
    function($scope, $http, $log, url, thumb_path, thumb_size) {

        $scope.villas = [];
        $scope.reviewByVilla = [];
        $scope.galleryByVilla = [];
        $scope.reviewStatus = false;

        $scope.getVillas = function(id) {

            var url_thumb,
                rateTrimmed;

            $http({
                method: 'GET',
                url: '/getarea/' + id
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {


                    if (value.gallery.length === 0) {
                        url_thumb = null;
                    } else {
                        $log.info(key);
                        url_thumb = url + thumb_path + '/' + value.gallery[0].original_name + '/' + thumb_size + '/temporary';
                    }

                    if (value.rate.length === 0) {
                        rateTrimmed = null;
                    } else {
                        rateTrimmed = value.rate[0].min_rate.slice(0, -3);
                    }

                    $scope.villas.push({
                        id: value.id,
                        title: value.title,
                        desc: value.intro,
                        bedroom: value.bedrooms_no,
                        environment: value.environment.title,
                        occupied: value.occupied_max,
                        review: value.review.length,
                        rate: rateTrimmed,
                        thumbnail: url_thumb,
                        url: url + '/' + value.area.slug + '/' + value.slug + '.html',
                        thumb_image: url + '/assets/images/lazy-image.png'
                    });
                });
                $log.info($scope.villas);
            }, function errorCallback(response) {
                $log.info(response);
            });

        };


        $scope.data = $scope.villas.slice(0, 6);
        $scope.getMoreData = function() {
            $scope.data = $scope.villas.slice(0, $scope.data.length + 6);
        }

        // Get Reviews By villa
        $scope.getReviewByVilla = function(id) {
            $http({
                method: 'GET',
                url: '/reviews/' + id + '/list'
            }).then(function successCallback(data) {
                $log.info(data);
                if (data.data.status === 1) {
                    angular.forEach(data.data.result, function(value, key) {
                        $scope.reviewByVilla.push({
                            id: value.id,
                            guestName: value.guest_name,
                            guestComment: value.comments,
                            guestCountry: value.country.name
                        });
                    });
                    $scope.reviewStatus = true;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Get Reviews By villa
        $scope.getGalleryByVilla = function(id) {
            $http({
                method: 'GET',
                url: '/villa-gallery/' + id + '/list'
            }).then(function successCallback(data) {
                $log.info(data);
                if (data.data.status === 1) {
                    angular.forEach(data.data.data, function(value, key) {
                        $scope.galleryByVilla.push({
                            url: url + '/original-image/' + value.original_name + '/detail',
                            caption: value.caption,
                            thumbUrl: url + thumb_path + '/' + value.original_name + '/' + thumb_size + '/gallery',
                            name: value.original_name
                        });
                    });
                }
                $log.info($scope.galleryByVilla);
            }, function errorCallback(response) {
                $log.info(response);
            });
        }

    }
]);

angular.module('frontend').filter('stripTags', function() {
    return function(text) {
        return text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});