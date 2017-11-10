angular.module('backend', [
    'ui.bootstrap',
    'angular-loading-bar',
    'ngFileUpload',
    'textAngular',
    'ngTagsInput',
    'ngSanitize',
    'ui.select',
    'ckeditor',
    'angularLazyImg'
]).value('admin_path', '/controlcenter');

/*******************************************************************
						Controllers
*******************************************************************/

// Admin Controller
angular.module('backend').controller('adminController', ['$scope', '$http', '$window', '$log', 'admin_path', 'Upload', '$timeout', '$uibModal',
    function($scope, $http, $window, $log, admin_path, Upload, $timeout, $uibModal) {

        $scope.villas = {};
        $scope.villaList = [];
        $scope.offersVilla = [];
        $scope.reviewsVilla = [];
        $scope.testimonialVilla = [];
        $scope.offersList = [];
        $scope.bedroom = {};
        $scope.bedroomList = [];
        $scope.formData = {};
        $scope.environmentList = [];
        $scope.seasonList = [];
        $scope.galleryGroupList = [];
        $scope.galleryList = [];
        $scope.areaList = [];
        $scope.contentSuccess = false;
        $scope.contentFailed = false;
        $scope.rateVillas = [];
        $scope.villaBedroomList = [];
        $scope.itemRate = [];
        $scope.itemGallery = [];
        $scope.numSeasons = 0;
        $scope.rate = {};
        $scope.existBedroomSeason = false;
        $scope.rateFailed = true;
        $scope.rateSuccess = true;
        $scope.ifImages = true;
        $scope.offers = {};
        $scope.reviews = {};

        $scope.languageList = [];
        $scope.contentFormatList = [];
        $scope.formatRightList = [];
        $scope.countryList = [];

        $scope.multipleBedroom = {};
        $scope.statusList = [{ "value": "draft", "title": "draft" }, { "value": "live", "title": "live" }];
        $scope.reviewsType = [{ "value": "manual", "title": "Manual" }, { "value": "auto", "title": "Auto" }];
        $scope.villas.Status = 'draft';

        $scope.isAdvancedSearch = false;

        $scope.advancedSearch = function() {

            $scope.isAdvancedSearch = true;

        }

        $scope.maxDate = $scope.maxDate ? null : new Date();

        $scope.openStart = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.datepicker = { 'openStart': true };
        };

        $scope.endStart = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.datepicker = { 'endStart': true };
        };

        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };

        $scope.intro = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.description = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.services = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.facilities = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.staff_detail = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.term_condition = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.ReviewsComment = {
            language: 'en',
            allowedContent: true,
            entities: false
        };

        $scope.TestimonialComment = {
            language: 'en',
            allowedContent: true,
            entities: false
        };


        // ********************* Bedroom ********************************* //


        // Get Bedroom List for villa input
        $scope.getBedrooms = function() {

            $http({
                method: 'GET',
                url: admin_path + '/api/bedroom'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.bedroomList.push({ id: value.id, title: value.title, number: value.number });
                });
                // $log.info($scope.bedroomList);
            }, function errorCallback(response) {
                $log.info(response);
            });
            $scope.multipleBedroom.selectedItem = $scope.bedroomList[0];
        };


        $scope.getVillaRateList = function(id) {

            $http({
                method: 'GET',
                url: admin_path + '/api/rates/' + id + '/villa'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.itemRate.push({
                        VillaId: value.VillaId,
                        Bedroom: value.Bedroom,
                        Season: value.Season,
                        StartDate: value.StartDate,
                        EndDate: value.EndDate,
                        MinimumStay: value.MinimumStay,
                        Tax: value.Tax,
                        Plus: value.Plus,
                        Rate: value.Rate,
                        SeasonTitle: value.SeasonTitle,
                        BedroomTitle: value.BedroomTitle,
                        RateId: value.RateId,
                    });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        // Get Seasons
        $scope.getSeasons = function() {

            $http({
                method: 'GET',
                url: admin_path + '/api/season'
            }).then(function successCallback(data) {
                angular.forEach(data.data.season, function(value, key) {
                    $scope.seasonList.push({ id: value.id, title: value.title });
                });
                $scope.numSeasons = data.data.numseasons;
            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        // Get Seasons
        $scope.getGalleryGroups = function() {

            $http({
                method: 'GET',
                url: admin_path + '/api/gallery-group'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.galleryGroupList.push({ id: value.id, title: value.title });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        $scope.getEnvironments = function() {

            $http({
                method: 'GET',
                url: admin_path + '/api/environment'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.environmentList.push({ id: value.id, title: value.title });
                });
            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        $scope.getAreas = function() {

            $http({
                method: 'GET',
                url: admin_path + '/api/area'
            }).then(function successCallback(data) {
                angular.forEach(data.data, function(value, key) {
                    $scope.areaList.push({ id: value.id, title: value.title });
                });
            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        // Get List of villas
        $scope.getVillaList = function() {
            $http({
                method: 'GET',
                url: admin_path + '/api/villa'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.villaList.push({
                        id: value.id,
                        title: value.title,
                        status: value.status == 1 ? 'Live' : 'Draft',
                        featured: value.featured == 1 ? 'Featured' : '',
                        area: value.area.title,
                        rateUrl: admin_path + '/villa/' + value.id + '/rates',
                        galleryUrl: admin_path + '/villa/' + value.id + '/gallery',
                        editUrl: admin_path + '/villa/' + value.id + '/edit',
                        deleteUrl: admin_path + '/villa/' + value.id
                    });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Get List of special offers
        $scope.getSpecialOffersList = function() {
            $http({
                method: 'GET',
                url: admin_path + '/api/special-offers'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.offersList.push({
                        id: value.id,
                        title: value.title,
                        period_end: value.period_end,
                        villa_name: value.villa.title,
                        editUrl: admin_path + '/special-offers/' + value.id + '/edit',
                        deleteUrl: admin_path + '/special-offers/' + value.id
                    });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Get List of villas for special offers
        $scope.offersVillaList = function() {
            $http({
                method: 'GET',
                url: admin_path + '/api/villa'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.offersVilla.push({
                        id: value.id,
                        title: value.title,
                        area: value.area.title,
                    });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Post Reviews from admin
        $scope.postReviews = function(param) {
            $log.info(param);
            $http({
                method: 'POST',
                url: admin_path + '/reviews',
                data: param,
            }).then(function successCallback(data) {
                if (data.data.status == 1) {

                    // $scope.contentSuccess = true;
                    // $scope.successMessage = "Content succesfully added to database";
                    // $scope.reviews = {};
                    $window.location.href = admin_path + '/reviews/?stat=1';
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed added content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        // Post Testimonial from admin
        $scope.postTestimonials = function(param) {
            $log.info(param);
            $http({
                method: 'POST',
                url: admin_path + '/testimonial',
                data: param,
            }).then(function successCallback(data) {
                if (data.data.status == 1) {

                    // $scope.contentSuccess = true;
                    // $scope.successMessage = "Content succesfully added to database";
                    // $scope.reviews = {};
                    $window.location.href = admin_path + '/testimonial/?stat=1';
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed added content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        // $scope.getReviews = function (id) {
        //     $http({
        //       method: 'GET',
        //       url: admin_path + '/api/reviews/'
        //     }).then(function successCallback(data) {

        //         $log.info(data.data);
        //         $scope.offers = data.data;
        //         $scope.offers.StartDate = new Date(data.data.StartDate);
        //         $scope.offers.EndDate = new Date(data.data.EndDate);

        //     }, function errorCallback(response) {
        //         $log.info(response);
        //     });
        // };

        // Get Reviews
        $scope.getReviews = function() {
            $http({
                method: 'GET',
                url: admin_path + '/api/reviews'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.reviewsVilla.push({
                        id: value.id,
                        villa: value.villa.title,
                        guestName: value.guest_name,
                        period_stay: value.arrival_date,
                        status: value.status,
                        approvedUrl: admin_path + '/reviews/' + value.id + '/approve',
                    });
                });

                $log.info($scope.reviewsVilla);

            }, function errorCallback(response) {
                $log.info(response);
            });
        }


        // Get Testimonial
        $scope.getTestimonials = function() {
            $http({
                method: 'GET',
                url: admin_path + '/api/testimonial'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.testimonialVilla.push({
                        id: value.id,
                        guestName: value.guest_name,
                        status: value.status,
                        approvedUrl: admin_path + '/testimonial/' + value.id + '/approve',
                    });
                });

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Post special offers
        $scope.postVillaOffers = function(param) {

            $log.info(param);
            $http({
                method: 'POST',
                url: admin_path + '/special-offers',
                data: param,
            }).then(function successCallback(data) {

                if (data.data.status == 1) {

                    $scope.contentSuccess = true;
                    $scope.successMessage = "Content succesfully added to database";
                    $scope.offers = {};
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed added content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });
        }

        // Update special offers
        $scope.editSpecialOffers = function(param) {

            $log.info('param');
            $log.info(param);

            $http({
                method: 'PUT',
                url: admin_path + '/special-offers/' + param.Id,
                data: param,
            }).then(function successCallback(data) {

                if (data.data.status == 1) {

                    // $scope.contentSuccess = true;
                    // $scope.successMessage = "Content succesfully updated";
                    // $scope.villas = {};
                    $window.location.href = admin_path + '/special-offers/?stat=1';
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed update content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        // Get Special Offers Information
        $scope.getSpecialOffers = function(id) {
            $http({
                method: 'GET',
                url: admin_path + '/api/special-offers/' + id + '/edit'
            }).then(function successCallback(data) {

                $log.info(data.data);
                $scope.offers = data.data;
                $scope.offers.StartDate = new Date(data.data.StartDate);
                $scope.offers.EndDate = new Date(data.data.EndDate);

            }, function errorCallback(response) {
                $log.info(response);
            });
        };

        // Delete Special Offers
        $scope.offersModal = function(param) {

            var size = 'sm';

            $scope.deleteOffers = param;

            var modalInstance = $uibModal.open({
                templateUrl: admin_path + '/offers-modal',
                controller: 'OffersController',
                size: size,
                resolve: {
                    items: function() {
                        return $scope.deleteOffers;
                    }
                }
            });

            modalInstance.result.then(function(offers_id) {


                $http({
                    method: 'DELETE',
                    url: admin_path + '/special-offers/' + offers_id,
                    data: param,
                }).then(function successCallback(data) {

                    if (data.data.status == 1) {
                        $window.location.reload();
                    } else {

                        $scope.contentFailed = true;
                        $scope.failedMessage = "Failed delete content";
                        $scope.errors = data.data.data;
                    }

                }, function errorCallback(response) {
                    $log.info(response);
                });

            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        // Delete Reviews
        $scope.reviewModal = function(param) {

            var size = 'sm';

            $scope.deleteReviews = param;

            var modalInstance = $uibModal.open({
                templateUrl: admin_path + '/reviews-modal',
                controller: 'ReviewsController',
                size: size,
                resolve: {
                    items: function() {
                        return $scope.deleteReviews;
                    }
                }
            });

            modalInstance.result.then(function(reviews_id) {


                $http({
                    method: 'DELETE',
                    url: admin_path + '/reviews/' + reviews_id,
                    data: param,
                }).then(function successCallback(data) {

                    if (data.data.status == 1) {
                        $window.location.reload();
                    } else {

                        $scope.contentFailed = true;
                        $scope.failedMessage = "Failed delete content";
                        $scope.errors = data.data.data;
                    }

                }, function errorCallback(response) {
                    $log.info(response);
                });

            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        // Delete Testimonial
        $scope.testimonialModal = function(param) {

            var size = 'sm';

            $scope.deleteTestimonial = param;

            var modalInstance = $uibModal.open({
                templateUrl: admin_path + '/testimonial-modal',
                controller: 'TestimonialController',
                size: size,
                resolve: {
                    items: function() {
                        return $scope.deleteTestimonial;
                    }
                }
            });

            modalInstance.result.then(function(testimonial_id) {


                $http({
                    method: 'DELETE',
                    url: admin_path + '/testimonial/' + testimonial_id,
                    data: param,
                }).then(function successCallback(data) {

                    if (data.data.status == 1) {
                        $window.location.reload();
                    } else {

                        $scope.contentFailed = true;
                        $scope.failedMessage = "Failed delete content";
                        $scope.errors = data.data.data;
                    }

                }, function errorCallback(response) {
                    $log.info(response);
                });

            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        // Get Villas Information
        $scope.getVillas = function(id) {
            $http({
                method: 'GET',
                url: admin_path + '/api/villa/' + id + '/edit'
            }).then(function successCallback(data) {

                $scope.villas = data.data;
                if ($scope.villas.Status === 0) {
                    $scope.villas.Status = 'draft';
                } else {
                    $scope.villas.Status = 'live';
                }

                if ($scope.villas.Featured === 1) {
                    $scope.villas.Featured = true;
                } else {
                    $scope.villas.Featured = false;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });
        };

        // Post Villas

        $scope.postVillas = function(param) {

            $log.info('param');
            $log.info(param);


            $http({
                method: 'POST',
                url: admin_path + '/villa',
                data: param,
            }).then(function successCallback(data) {

                if (data.data.status == 1) {
                    $scope.contentFailed = false;
                    $scope.contentSuccess = true;
                    $scope.successMessage = "Content succesfully added to database";
                    $scope.villas = {};
                } else {
                    $scope.contentSuccess = false;
                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed added content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }


        $scope.editVillas = function(param) {

            // $log.info('param');
            // $log.info(param);

            $http({
                method: 'PUT',
                url: admin_path + '/villa/' + param.Id,
                data: param,
            }).then(function successCallback(data) {

                if (data.data.status == 1) {

                    // $scope.contentSuccess = true;
                    // $scope.successMessage = "Content succesfully updated";
                    // $scope.villas = {};
                    $window.location.href = admin_path + '/villa/?stat=1';
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed update content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        // Delete Villa
        $scope.villaModal = function(param) {

            var size = 'sm';

            $scope.deleteVilla = param;

            var modalInstance = $uibModal.open({
                templateUrl: admin_path + '/villa-modal',
                controller: 'VillaController',
                size: size,
                resolve: {
                    items: function() {
                        return $scope.deleteVilla;
                    }
                }
            });

            modalInstance.result.then(function(villa_id) {


                $http({
                    method: 'DELETE',
                    url: admin_path + '/villa/' + villa_id,
                    data: param,
                }).then(function successCallback(data) {

                    if (data.data.status == 1) {
                        $window.location.reload();
                    } else {

                        $scope.contentFailed = true;
                        $scope.failedMessage = "Failed delete content";
                        $scope.errors = data.data.data;
                    }

                }, function errorCallback(response) {
                    $log.info(response);
                });

            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        // Bedroom Villa
        $scope.getVillaBedrooms = function(id) {

            $http({
                method: 'GET',
                url: admin_path + '/api/villa/' + id + '/bedrooms'
            }).then(function successCallback(data) {
                angular.forEach(data.data, function(value, key) {
                    $scope.villaBedroomList.push({ id: value.id, title: value.title });
                });
                $scope.getVillaRateList(id);
            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        // Add Rates Form
        $scope.addRates = function(param, villaId) {


            function checkValue(Bedroom, Season) {
                var getBedroom, getSeason;

                $log.info('Bedroom: ' + Bedroom);
                $log.info('Season: ' + Season);

                angular.forEach($scope.itemRate, function(value, key) {
                    getBedroom = value.Bedroom.indexOf(Bedroom);
                    getSeason = value.Season.indexOf(Season);
                    $log.info('get bedroom: ' + getBedroom);
                    $log.info('get season: ' + getSeason);
                    // Check if Bedroom & Season exist on rates form
                    if (getBedroom == 0 && getSeason == 0) {
                        $scope.existBedroomSeason = true;
                    }
                });
            }

            checkValue(param.Bedrooms, param.Seasons);

            if ($scope.existBedroomSeason == true) {
                $scope.rateFailed = false;
                $scope.rateMessage = 'Bedroom and season already exist.';
                $scope.existBedroomSeason = false;
            } else {
                $scope.rateFailed = true;

                // if ($scope.itemRate.length < $scope.numSeasons) {
                $log.info(getSeasonsTitle(param.Seasons));
                $scope.itemRate.push({
                    VillaId: villaId,
                    Bedroom: param.Bedrooms,
                    Season: param.Seasons,
                    StartDate: null,
                    EndDate: null,
                    MinimumStay: null,
                    Tax: null,
                    Plus: null,
                    Rate: null,
                    SeasonTitle: getSeasonsTitle(param.Seasons),
                    BedroomTitle: getBedroomsTitle(param.Bedrooms),
                    RateId: 0,
                });
                // }
            }

            function getSeasonsTitle(id) {
                var title = null;
                angular.forEach($scope.seasonList, function(value, key) {
                    if (value.id == id) {
                        title = value.title;
                    }
                });

                return title;
            }

            function getBedroomsTitle(id) {
                var title = null;
                angular.forEach($scope.villaBedroomList, function(value, key) {
                    if (value.id == id) {
                        title = value.title;
                    }
                });

                return title;
            }

        }

        // Save Rate
        $scope.saveRates = function(param) {
            $log.info(param);

            $http({
                method: 'POST',
                url: admin_path + '/rates',
                data: param,
            }).then(function successCallback(data) {

                $log.info(data);

                if (data.data.status == 1) {

                    $scope.rateFailed = true;
                    $scope.rateSuccess = false;
                    $scope.rateMessage = data.data.data;
                    $window.location.href = admin_path + '/villa/' + param.VillaId + '/rates';
                    // $scope.villas = {};
                } else if (data.data.status == 0) {

                    $scope.rateFailed = false;
                    $scope.rateSuccess = true;
                    $scope.rateMessage = "Failed added rate";
                    $scope.errors = data.data.data;
                } else if (data.data.status == 3) {

                    $scope.rateFailed = false;
                    $scope.rateSuccess = true;
                    $scope.rateMessage = "Failed added rate";
                    $scope.errors = data.data.data;
                } else if (data.data.status == 4) {
                    $scope.rateFailed = true;
                    $scope.rateSuccess = false;
                    $scope.rateMessage = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });
        }




        $scope.addImages = function(id, count) {

            if (count < 6) {
                $scope.ifImages = false;
                $scope.itemGallery.push({
                    VillaId: id,
                    Caption: null,
                    Group: null,
                    MainImage: false,
                    Images: null,
                });
            }
        };

        // Gallery list by villa id
        $scope.listGallery = function(id) {

            // function insert(str, sub, pos) {
            //     return str.slice(0, pos) + sub + str.slice(pos);
            // }

            $http({
                method: 'GET',
                url: admin_path + '/api/gallery/' + id + '/list'
            }).then(function successCallback(data) {
                $log.info(data.data);
                angular.forEach(data.data, function(value, key) {
                    $scope.galleryList.push({
                        Id: value.id,
                        Caption: value.caption,
                        Image: value.path,
                        Group: value.group_id,
                        MainImage: value.main_image == 1 ? true : false,
                    });
                });
            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        $scope.editGallery = function(param) {


            $http({
                method: 'PUT',
                url: admin_path + '/gallery/' + param.Id,
                data: param,
            }).then(function successCallback(data) {

                if (data.data.status == 1) {
                    // $scope.contentSuccess = true;
                    // $scope.successMessage = "Content succesfully updated";
                    // $scope.villas = {};
                    $window.location.reload();
                } else {

                    $scope.contentFailed = true;
                    $scope.failedMessage = "Failed update content";
                    $scope.errors = data.data.data;
                }

            }, function errorCallback(response) {
                $log.info(response);
            });

        }

        $scope.galleryModal = function(param) {

            var size = 'sm';

            $scope.deleteGallery = param;

            var modalInstance = $uibModal.open({
                templateUrl: admin_path + '/gallery-modal',
                controller: 'GalleryController',
                size: size,
                resolve: {
                    items: function() {
                        return $scope.deleteGallery;
                    }
                }
            });

            modalInstance.result.then(function(gallery_id) {


                $http({
                    method: 'DELETE',
                    url: admin_path + '/gallery/' + gallery_id,
                    data: param,
                }).then(function successCallback(data) {

                    if (data.data.status == 1) {
                        $window.location.reload();
                    } else {

                        $scope.contentFailed = true;
                        $scope.failedMessage = "Failed delete content";
                        $scope.errors = data.data.data;
                    }

                }, function errorCallback(response) {
                    $log.info(response);
                });

            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        // Upload and store image input
        $scope.doUpload = function(files) {

            // var getLength = $scope.itemGallery.length;
            $log.info(files);
            // $log.info(getLength);

            if (files && files.length) {
                $scope.loading = true;
                for (var i = 0; i < files.length; i++) {
                    var file = files[i].Images;
                    Upload.upload({
                        url: admin_path + '/gallery',
                        file: file,
                        fields: {
                            'id': files[i].VillaId,
                            'caption': files[i].Caption,
                            'group_id': files[i].Group,
                            'main_image': files[i].MainImage
                        }
                    }).progress(function(evt) {
                        $scope.loading = false;
                    }).success(function(resp) {
                        $scope.loading = false;

                        if (resp.status === 1) {
                            $window.location.reload();
                        }

                    }).error(function() {
                        $scope.loading = false;
                        $log.info('error upload image');
                    });
                }
            }
        }

        $scope.countries = function() {


            $http({
                method: 'GET',
                url: admin_path + '/api/countries'
            }).then(function successCallback(data) {

                angular.forEach(data.data, function(value, key) {
                    $scope.countryList.push({ id: key, name: value });

                });

            }, function errorCallback(response) {
                $log.info(response);
            });

        };

    }
]);

// Profile Controller
angular.module('backend').controller('profileController', ['$scope', '$http', '$log', 'admin_path', '$filter', '$uibModal', 'Upload', '$window',
    function($scope, $http, $log, admin_path, $filter, $uibModal, Upload, $window) {

        $scope.countryList = [];
        $scope.maxDate = $scope.maxDate ? null : new Date();

        $scope.openDOB = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.datepicker = { 'openedDOB': true };
        };

        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };

        $scope.countries = function() {


            $http({
                method: 'GET',
                url: admin_path + '/api/countries'
            }).then(function successCallback(data) {

                angular.forEach(data.data, function(value, key) {
                    $scope.countryList.push({ id: key, name: value });

                });

            }, function errorCallback(response) {
                $log.info(response);
            });

        };

        $scope.getProfile = function(id) {

            $scope.profile = {};

            $http({
                method: 'GET',
                url: admin_path + '/profile/' + id + '/edit'
            }).then(function successCallback(data) {

                angular.forEach(data.data, function(value, key) {
                    $scope.profile = value;
                    $scope.profile.dob = new Date(value.dob);
                });

            }, function errorCallback(response) {
                $log.info(response);
            });

            $scope.countries();
        };

        $scope.updateProfile = function(param, id) {

            param.dob = $filter('date')(param.dob, 'yyyy-MM-dd');

            $http({
                method: 'PUT',
                url: admin_path + '/profile/' + id,
                data: param
            }).then(function successCallback(data) {

                if (data.data.status === 1) {
                    $scope.alertProfile = true;
                    $scope.alertMessage = 'Profile Updated!';
                }
                $log.info(data.data.status);
            }, function errorCallback(response) {
                $log.info(responses);
            });

        };

        $scope.updatePassword = function(param, id) {

            $scope.alertPassword = false;
            $scope.alertPasswordWrong = false;

            $http({
                method: 'PUT',
                url: admin_path + '/profile/changepwd/' + id,
                data: param
            }).then(function successCallback(data) {
                $log.info(data);
                if (data.data.status === 1) {
                    $scope.alertPassword = true;
                    $scope.alertMessage = 'Password updated!';
                    $scope.password.current = null;
                    $scope.password.new1 = null;
                    $scope.password.new2 = null;
                } else if (data.data.status === 2) {
                    $scope.alertPasswordWrong = true;
                    $scope.alertMessageWrong = 'Your current password is wrong!';
                }

            }, function errorCallback(response) {
                $log.info(responses);
            });
        };

        $scope.uploadPhoto = function() {
            $scope.isUpload = true;
        }

        $scope.cancelPhoto = function() {
            $scope.isUpload = false;
        }

        $scope.doUpload = function(files, id) {
            $scope.loading = true;
            if (files && files.length) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    Upload.upload({
                        url: admin_path + '/profile',
                        file: file,
                        fields: {
                            'id': id
                        }
                    }).progress(function(evt) {
                        $scope.loading = false;
                        $log.info('evt');
                        $log.info(evt);
                    }).success(function(resp) {
                        $scope.loading = false;
                        $log.info('resp2');
                        $log.info(resp);

                        if (resp.status === 1) {
                            $window.location.reload();
                        }
                        //refresh setting from API
                        //$state.reload();
                    }).error(function() {
                        $scope.loading = false;
                        //$log.info('error upload image');
                    });
                }
            }
        };


    }
]);

// Modal Instance
angular.module('backend').controller('GalleryController', ['$scope', 'admin_path', '$uibModalInstance', '$log', 'items',
    function($scope, admin_path, $uibModalInstance, $log, items) {

        $scope.ok = function() {
            $uibModalInstance.close(items.Id);
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };


    }
]);

// Modal Instance
angular.module('backend').controller('VillaController', ['$scope', 'admin_path', '$uibModalInstance', '$log', 'items',
    function($scope, admin_path, $uibModalInstance, $log, items) {

        $scope.ok = function() {
            $uibModalInstance.close(items.id);
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };


    }
]);

// Modal Instance
angular.module('backend').controller('OffersController', ['$scope', 'admin_path', '$uibModalInstance', '$log', 'items',
    function($scope, admin_path, $uibModalInstance, $log, items) {

        $scope.ok = function() {
            $uibModalInstance.close(items.id);
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };


    }
]);

// Modal Instance
angular.module('backend').controller('ReviewsController', ['$scope', 'admin_path', '$uibModalInstance', '$log', 'items',
    function($scope, admin_path, $uibModalInstance, $log, items) {

        $scope.ok = function() {
            $uibModalInstance.close(items.id);
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };


    }
]);

// Modal Instance
angular.module('backend').controller('TestimonialController', ['$scope', 'admin_path', '$uibModalInstance', '$log', 'items',
    function($scope, admin_path, $uibModalInstance, $log, items) {

        $scope.ok = function() {
            $uibModalInstance.close(items.id);
        };

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };


    }
]);
/*******************************************************************
						Directives
*******************************************************************/

angular.module('backend').filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function(item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    };
});

// Permission Directive
// angular.module('backend').directive('permissionavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.permissionavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/permissions/' + modelValue + '/exist'
//                     }).
//                     success(function(data) {

//                     	if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Permission Directive
// angular.module('backend').directive('settingavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.settingavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/settings/' + modelValue + '/exist'
//                     }).
//                     success(function(data) {

//                     	if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Villa Name Directive
angular.module('backend').directive('villaavail', ['$q', '$http', '$log', 'admin_path', function($q, $http, $log, admin_path) {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            ctrl.$asyncValidators.villaavail = function(modelValue) {
                var deferred = $q.defer();
                $http({
                    method: 'GET',
                    url: admin_path + '/api/villa/' + modelValue + '/exist'
                }).
                success(function(data) {

                    if (data.error === false && data.exist === false) {
                        //user still available
                        deferred.resolve();
                    } else {
                        deferred.reject();
                    }
                }).
                error(function() {
                    deferred.reject();
                });
                return deferred.promise;
            };
        }
    };
}]);

// Demographic Directive
// angular.module('backend').directive('demographicavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.demographicavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 var valueFiltered = modelValue.replace(/\//g, '-');

//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/demographic/' + valueFiltered + '/exist'
//                     }).
//                     success(function(data) {

//                         if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Content Format Directive
// angular.module('backend').directive('contentformatavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.contentformatavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 var valueFiltered = modelValue.replace(/\//g, '-');

//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/content-format/' + valueFiltered + '/exist'
//                     }).
//                     success(function(data) {

//                         if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Format right Directive
// angular.module('backend').directive('formatrightavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.formatrightavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 var valueFiltered = modelValue.replace(/\//g, '-');

//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/format-right/' + valueFiltered + '/exist'
//                     }).
//                     success(function(data) {

//                         if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Language Directive
// angular.module('backend').directive('languageavail', ['$q', '$http', '$log', 'admin_path', function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.languageavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 var valueFiltered = modelValue.replace(/\//g, '-');

//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/language/' + valueFiltered + '/exist'
//                     }).
//                     success(function(data) {

//                         if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// Role Directive
// angular.module('backend').directive('roleavail', ['$q', '$http', '$log', 'admin_path',  function ($q, $http, $log, admin_path) {
//     return {
//         require: 'ngModel',
//         link: function(scope, elm, attrs, ctrl) {
//             ctrl.$asyncValidators.roleavail = function(modelValue) {
//                 var deferred = $q.defer();
//                 $http({
//                     method  : 'GET',
//                     url     : admin_path + '/api/roles/' + modelValue + '/exist'
//                     }).
//                     success(function(data) {

//                     	if (data.error === false && data.exist === false) {
//                             //user still available
//                             deferred.resolve();
//                         } else {
//                             deferred.reject();
//                         }
//                     }).
//                     error(function() {
//                         deferred.reject();
//                 });
//                 return deferred.promise;
//             };
//         }
//     };   
// }]);

// angular.module('backend').directive('compare', function() {
//         return {
//             require: 'ngModel',
//             scope: {
//                 otherModelValue: '=compare'
//             },
//             link: function(scope, elm, attrs, ctrl) {
//                 ctrl.$validators.compare = function(modelValue) {
//                     return modelValue === scope.otherModelValue;
//                 };
//                 scope.$watch('otherModelValue', function() {
//                     ctrl.$validate();
//                 });
//             }
//         };   
//     });