{% extends "../../Core/View/Layout/Default/admin-main.volt" %}

{% block title %}
    {{ 'page-title-edit'|i18n }} | {{ config.global.title }}
{% endblock %}

{% block css %}
    <link href="{{ static_url('min/index.php?g=cssDefaultProductAdmin&rev=' ~ config.global.version.css) }}" rel="stylesheet" type="text/css">
{% endblock %}

{% block js %}
    <script type="text/javascript" src="{{ static_url('min/index.php?g=jsDefaultProductAdmin&rev=' ~ config.global.version.js) }}"></script>
    <script data-preload="true" data-path="{{ static_url('plugins/pixie') }}" src="{{ static_url('plugins/pixie/pixie-integrate.js') }}"></script>
    <script>
        var productId = 0;
        var myPixie = Pixie.setOptions({
            replaceOriginal: true,
            onSave: function(data, img) {
                $.ajax({
                    type: 'POST',
                    url: root_url + '/product/editimage',
                    data: {
                        imgData: data,
                        productId: productId
                    },
                }).success(function(response) {
                    toastr.success(response._meta.message);
                });
            }
        });
        // myPixie.enableInteractiveMode();

        $('.edit-image').on('click', function(e) {
            productId = e.target.id;
            console.log(productId);
            myPixie.open({
                url: e.target.alt,
                image: e.target
            });
        });
    </script>
{% endblock %}

{% block content %}
<form
    id="edit-product"
    class="form-horizontal"
    role="form"
    method="post"
    action=""
    enctype="multipart/form-data">
    <input
        type="hidden"
        name="{{ security.getTokenKey() }}"
        value="{{ security.getToken() }}" />
    <div class="container-fluid container-fixed-lg bg-white">
        <div class="panel panel-transparent">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        {{ content() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.name'|i18n }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="name"
                                    value="{% if formData['name'] is defined %}{{ formData['name'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.category'|i18n }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select
                                    class="cs-select cs-skin-slide"
                                    data-init-plugin="cs-select"
                                    name="pcid">
                                    <option value="1">----</option>
                                    {% for n, cat in categories %}
                                        <option
                                            value="{{ cat.id }}"
                                            {% if formData['pcid'] is defined and formData['pcid'] == cat.id %}
                                            selected="selected"
                                            {% endif %}>
                                            {{ str_repeat('-', cat.level) }} {{ cat.name }}
                                        </option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.barcode'|i18n }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="barcode"
                                    value="{% if formData['barcode'] is defined %}{{ formData['barcode'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.vendorprice'|i18n }}
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="vendorprice"
                                    value="{% if formData['vendorprice'] is defined %}{{ formData['vendorprice'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.sellprice'|i18n }}
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="sellprice"
                                    value="{% if formData['sellprice'] is defined %}{{ formData['sellprice'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.discountpercent'|i18n }}
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="discountpercent"
                                    value="{% if formData['discountpercent'] is defined %}{{ formData['discountpercent'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.content'|i18n }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <div class="summernote-wrapper">
                                    <textarea
                                        class="form-control"
                                        placeholder=""
                                        name="content"
                                        id="summernote">{% if formData['content'] is defined %}{{ formData['content'] }}{% endif %}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.seodescription'|i18n }}
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                    name="seodescription"
                                    value="{% if formData['seodescription'] is defined %}{{ formData['seodescription'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.seokeyword'|i18n }}
                            </label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control tagsinput"
                                    placeholder=""
                                    name="seokeyword"
                                    value="{% if formData['seokeyword'] is defined %}{{ formData['seokeyword'] }}{% endif %}"
                                     />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.status'|i18n }}
                                <span class="required">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select
                                    class="cs-select cs-skin-slide"
                                    data-init-plugin="cs-select"
                                    name="status">
                                    {% for status in statusList %}
                                    <option
                                        value="{{ status['value'] }}"
                                        {% if formData['status'] is defined and formData['status'] == status['value'] %}
                                            selected="selected"
                                        {% endif %}>
                                        {{ status['name'] | i18n }}
                                    </option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-fixed-lg">
        <div class="panel panel-transparent">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                {{ 'form.cover'|i18n }}
                                <img id="{{ id }}"  class="edit-image" src="{{ static_url(formData['thumbnailImage']) }}" alt="{{ static_url('uploads' ~ formData['image']) }}" />
                                Medium: 340 x 434 <br/>
                                Thumb: 190 x 242
                            </label>
                            <div class="col-sm-9">
                                <div id="uploadCover" class="dropzone" style="min-height: 240px"></div>
                                <input
                                    type="hidden"
                                    name="image"
                                    value="{% if formData['image'] is defined %}{{ formData['image'] }}{% endif %}"
                                    id="uploadCoverInput"/>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ 'form.gallery'|i18n }}</label>
                            <div class="col-sm-9">
                                <div id="uploadImages" class="dropzone" style="min-height: 240px"></div>
                                <div class="multipleFiles"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                            <span class="required">*</span>: {{ 'default.required'|i18n }}
                            </div>
                            <div class="col-sm-9">
                                <button class="btn btn-success" type="submit" name="fsubmit">{{ 'form.button-submit'|i18n }}</button>
                                <button class="btn btn-default" type="reset"><i class="pg-close"></i> {{ 'form.button-clear'|i18n }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var imageList = `{{ formData['imageList'] }}`;
</script>
{% endblock %}
