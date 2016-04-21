$(document).ready(function() {
    Dropzone.autoDiscover = false;

    // Cover upload
    $('div#uploadCover').dropzone({
        url: root_url + '/product/uploadimage',
        paramName: 'image',
        maxFileSize: 10,
        maxFiles: 1,
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                toastr.error("Cannot upload more than 1 file!");
            });
            this.on("success", function(file, response) {
                if (response._meta.status == true) {
                    var path = response._result.image.path;
                    $("#uploadCoverInput").val(path);
                }
                toastr.success(response._meta.message);
            });
            this.on("removedfile", function(file) {
                var name = file.name;
                $.ajax({
                    type: 'POST',
                    url: root_url + '/product/deleteimage',
                    data: "name="+name,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        if (response._meta.status == true) {
                            // Remove input value
                            $("#uploadCoverInput").val("");

                            toastr.success(response._meta.message);
                        } else {
                            toastr.error(response._meta.message);
                        }
                    }
                });
            });
        },
    });

    // Gallery upload
    $('div#uploadImages').dropzone({
        url: root_url + '/product/uploadimage',
        paramName: 'products',
        autoProcessQueue: true,
        uploadMultiple: true,
        parallelUploads: 10,
        maxFiles: 10,
        addRemoveLinks: true,
        dictDefaultMessage: "Drop the images you want to upload here",
        dictFileTooBig: "Image size is too big. Max size: 10mb.",
        dictMaxFilesExceeded: "Only 10 images allowed per upload.",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        init: function() {
            // Show images existed
            if ($("#edit-product").length > 0) {
                var thisDropzone = this;
                var galleries = $.parseJSON(imageList);
                if (galleries.length > 0) {
                    $('#uploadImages .dz-message').remove();
                    $.each(galleries, function(key, item) {
                        var mockFile = {name: item.name, size: item.size};
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, static_url + item.path);
                    });
                }
            }

            this.on("success", function(file, response) {
                if (response._meta.status == true) {
                    $.each(response._result, function(key, item) {
                        var path = '<input type="hidden" name="uploadfiles[]" value="' + item.path + '"/>';
                        $('.multipleFiles').append(path);
                    });
                }
                toastr.success(response._meta.message);
            });
            this.on("removedfile", function(file) {
                var name = file.name;
                if ($("#edit-product").length > 0) {
                    var data = "name=" + name + "&edit=1";
                } else {
                    var data = "name="+name;
                }

                $.ajax({
                    type: 'POST',
                    url: root_url + '/product/deleteimage',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        if (response._meta.status == true) {
                            // Remove input value
                            $('input[type=hidden]').each(function() {
                                if ($(this).val() == response._result) {
                                    $(this).remove();
                                }
                            });

                            toastr.success(response._meta.message);
                        } else {
                            toastr.error(response._meta.message);
                        }
                    }
                });
            });
        },
    });

    $('#summernote').summernote({
        height: 390,
        onfocus: function(e) {
            $('body').addClass('overlay-disabled');
        },
        onblur: function(e) {
            $('body').removeClass('overlay-disabled');
        },
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        }
    });

    // upload image to server from summernote editor
    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: root_url + "/product/uploadimage",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var url = static_url + response._result.file.path;
                editor.insertImage(welEditable, url);
            }
        });
    }

    // inline-edit HOT
    $('.ishot').editable({
        url: root_url + '/product/inlineupdate',
        value: 0,
        source: [
            {value: 1, text: 'HOT'},
            {value: 0, text: '???'}
        ],
        success: function(response, newValue) {
            if(response._meta.status == false) {
                return response._meta.message;
            } else {
                toastr.success(response._meta.message);
            }
        }
    });

    // inline-edit NEW
    $('.isnew').editable({
        url: root_url + '/product/inlineupdate',
        value: 0,
        source: [
            {value: 1, text: 'NEW'},
            {value: 0, text: '???'}
        ],
        success: function(response, newValue) {
            if(response._meta.status == false) {
                return response._meta.message;
            } else {
                toastr.success(response._meta.message);
            }
        }
    });

    $('.tagsinput').tagsInput({
        width: "100%",
        defaultText: "Nhập từ"
    });

    var scntDiv = $('#p_scents');
    var i = $('#p_scents .row').length || 0;
    $('#addScnt').on('click', function() {
        var html = '';
        html += '<div class="row m-b-10">'
        html += '   <div class="form-group">';
        html += '       <div class="col-sm-2">'+ $('.product-option-group').html() +'</div>';
        html += '       <div class="col-sm-6">';
        html += '           <input type="text" name="" class="form-control input-variant" placeholder="Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy)">';
        html += '       </div>';
        html += '       <div class="col-sm-2"><a href="javascript:;" class="btn btn-danger btn-variant" id="remScnt"><i class="fa fa-trash-o"></i></a></div>';
        html += '   </div>';
        html += '</div>';

        $(html).appendTo(scntDiv).promise().done(function() {
            $('.select-variant').find('option:selected').each(function(index, item) {
                $('.select-variant').find('option[value='+ $(item).val() +']').prop('disabled', true);
            });
            // Appned input name
            var input = $(this).find('.input-variant');
            $(input).attr('name', 'optiongroup['+ $(this).find('option:selected').text().toLowerCase() +']');

            var previous = 0;
            $('.select-variant').on('focus', function() {
                previous = $(this).find('option:selected').val();
            }).on('change', function(){
                var selectedText = $(this).children('option').filter(':selected').text().toLowerCase();
                var input = $(this).parents('.form-group').find('.input-variant');
                // Grant to input
                var currentValue = $(this).find('option:selected').val();
                $(input).attr('name', 'optiongroup['+ selectedText +']');

                $('.select-variant').find('option[value='+currentValue+']').prop('disabled', true);
                $('.select-variant').find('option[value='+previous+']').prop('disabled', false);
                previous = currentValue;
            });
        });
        if (($('.select-variant').find('option:selected').length - 1) == 3) {
            $(this).hide();
            i--;
        }
        i++;
    });

    // remove a variant
    $('body').on('click', '#remScnt', function() {
        var currentSelectEleVariant = $(this).parent().parent().parent().find('.select-variant');
        var currentValue = $(currentSelectEleVariant).find('option:selected').val();
        $('.select-variant').find('option[value='+currentValue+']').prop('disabled', false);

        // // Remove element variant
        $(this).parent().parent().parent().remove();
        // Show if addbtn hide
        var eleBtnAdd = $('#addScnt');
        if ($(eleBtnAdd).is(":visible") == false) {
            $(eleBtnAdd).show();
        }
        i--;

        return false;
    });

    // auto focus and turn input to tags input
    $('body').on('focus', '.input-variant', function() {
        var tg = $(this).tagsInput({
            width:'100%',
            height:'40px',
            defaultText: "Giá trị tt"
        });
        var tg_id = $(tg[0]).attr('id');
        $('#' + tg_id + '_tag').focus();
        return false;
    });

    $('.showVariant').click(function() {
        var th = '';
        var th_variant = [];
        var id = $(this).attr('id');
        $.ajax({
            type: 'GET',
            url: root_url + '/product/showvariant',
            data: "id=" + id,
            cache: false,
            success: function(response) {
                th += '<th>Hình</th>';
                // console.log(response);
                var res = response._result;
                var thead = $("#modalSlideUp thead tr");
                $(res.thead).each(function(index, item) {
                    th += '<th>'+ item +'</th>';
                });
                th += '<th>Số lượng</th>';
                th += '<th>Giá bán</th>';
                th += '<th>Mã SP</th>';
                th += '<th></th>';
                thead.html(th);

                var tbody = '';
                $(res.trow).each(function(index, row) {
                    var tr = '<tr>';
                    tr += '<td class="v-align-middle">';
                    tr += '<div id="'+ row.id +'" class="optionCover dropzone" style="min-height: 80px">';
                    tr += '<input type="hidden" class="imageUrl" value="'+ row.image +'"/></div>';
                    tr += '</td>';
                    $(res.thead).each(function(index, item) {
                        tr += '<td class="v-align-middle"><a class="product-edit '+ item +'" data-name="'+ item +'" data-pk="'+ row.id +'" data-value="'+ row[item] +'">'+ row[item] +'</a></td>';
                    });
                    tr += '<td class="v-align-middle"><a class="product-edit" data-name="quantity" data-pk="'+ row.id +'" data-value="'+ row.quantity +'">'+ row.quantity +'</a></td>';
                    tr += '<td class="v-align-middle"><a class="product-edit" data-name="price" data-pk="'+ row.id +'" data-value="'+ row.price +'">'+ row.price +'</a> &#8363;</td>';
                    tr += '<td class="v-align-middle"><a class="product-edit" data-name="barcode" data-pk="'+ row.id +'" data-value="'+ row.barcode +'">'+ row.barcode +'</a></td>';
                    tr += '<td class="v-align-middle"><button class="btn btn-xs btn-danger" id="'+ row.id +'"><i class="fa fa-trash-o"></i></button></td>';
                    tr += '</tr>';
                    tbody += tr;
                });
                $("#modalSlideUp tbody").html(tbody);

                var modalElem = $('#modalSlideUp');
                $(modalElem).modal('show').promise().done(function() {
                    // product inline edit variant
                    $('.product-edit').editable({
                        mode: 'inline',
                        url: root_url + '/product/editvariant',
                        success: function(response) {
                            if(response._meta.status == true) {
                                toastr.success(response._meta.message);
                                if (typeof response._result.totalProduct != 'undefined') {
                                    $('#quantity_' + response._result.pid).text(response._result.totalProduct);
                                }

                            } else {
                                toastr.error(response._meta.message);
                            }
                        }
                    });

                    // Option Cover upload
                    var optionId = 0;
                    $('.optionCover').dropzone({
                        url: root_url + '/product/uploadoptionimage',
                        dictDefaultMessage: '<i class="fa fa-camera"></i>',
                        paramName: 'image',
                        maxFileSize: 10,
                        maxFiles: 1,
                        addRemoveLinks: true,
                        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
                        init: function() {
                            // Show existed image
                            var thisDropzone = this;
                            var imageUrl = $(this.element).find('.imageUrl');
                            var image = $(imageUrl).val();
                            if (image.length > 0) {
                                $(this.element).find('.dz-message').hide();
                                var mockFile = {name: image, size: 1000};
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, image);
                            }

                            this.on("maxfilesexceeded", function(file) {
                                toastr.error("Cannot upload more than 1 file!");
                            });

                            this.on("addedfile", function(file) {
                                optionId = $(this.element).attr('id');
                            });

                            this.on("success", function(file, response) {
                                if (response._meta.status == true) {
                                    var path = response._result.image.path;
                                    // update database of specified option
                                    $.ajax({
                                        type: 'POST',
                                        url: root_url + '/product/updateoptionimage',
                                        data: 'id=' + optionId + '&path=' + path,
                                        dataType: 'json',
                                        cache: false,
                                        success: function(response) {
                                            if (response._meta.status == true) {
                                                toastr.success(response._meta.message);
                                            } else {
                                                toastr.error(response._meta.message);
                                            }
                                        }
                                    });
                                }
                                toastr.success(response._meta.message);
                            });

                            this.on("removedfile", function(file) {
                                $.ajax({
                                    type: 'POST',
                                    url: root_url + '/product/deleteoptionimage',
                                    data: 'id=' + $(this.element).attr('id'),
                                    dataType: 'json',
                                    cache: false,
                                    success: function(response) {
                                        if (response._meta.status == true) {
                                            toastr.success(response._meta.message);
                                            var divId = $(this.element).attr('id');
                                            $('div#' + divId).find('.dz-message').show();
                                        } else {
                                            toastr.error(response._meta.message);
                                        }
                                    }
                                });
                            });
                        },
                    });

                });
                modalElem.children('.modal-dialog').addClass('modal-lg');
            }
        });
    });
});
