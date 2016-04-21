{% extends "../../Core/View/Layout/Default/admin-main.volt" %}

{% block title %}
    {{ 'page-title-create'|i18n }} | {{ config.global.title }}
{% endblock %}

{% block css %}
    <link href="{{ static_url('min/index.php?g=cssDefaultProductAdmin&rev=' ~ config.global.version.css) }}" rel="stylesheet" type="text/css">
{% endblock %}

{% block js %}
    <script type="text/javascript" src="{{ static_url('min/index.php?g=jsDefaultProductAdmin&rev=' ~ config.global.version.js) }}"></script>
{% endblock %}

{% block content %}
<form
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
                {{ content() }}
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group form-group-default required">
                            <label>{{ 'form.name'|i18n }}</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="name"
                                value="{% if formData['name'] is defined %}{{ formData['name'] }}{% endif %}"
                                required />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label>{{ 'form.category'|i18n }}</label>
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
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label>{{ 'form.status'|i18n }}</label>
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
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label>{{ 'form.vendorprice'|i18n }}</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="vendorprice"
                                value="{% if formData['vendorprice'] is defined %}{{ formData['vendorprice'] }}{% endif %}"
                                 />
                            <span class="input-group-addon">&#8363;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label>{{ 'form.sellprice'|i18n }}</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="sellprice"
                                value="{% if formData['sellprice'] is defined %}{{ formData['sellprice'] }}{% endif %}"
                                 />
                            <span class="input-group-addon">&#8363;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default input-group">
                            <label>{{ 'form.discountpercent'|i18n }}</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="discountpercent"
                                value="{% if formData['discountpercent'] is defined %}{{ formData['discountpercent'] }}{% endif %}"
                                 />
                            <span class="input-group-addon">&#37;</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-group-default">
                            <label>{{ 'form.barcode'|i18n }}</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                name="barcode"
                                value="{% if formData['barcode'] is defined %}{{ formData['barcode'] }}{% endif %}"
                                 />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group form-group-default">
                            <label>{{ 'form.seodescription'|i18n }}</label>
                            <textarea
                                class="form-control"
                                placeholder=""
                                name="seodescription"
                                style="height:104px">{% if formData['seodescription'] is defined %}{{ formData['seodescription'] }}{% endif %}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ 'form.seokeyword'|i18n }}</label>
                            <textarea
                                class="form-control tagsinput"
                                placeholder=""
                                name="seokeyword">{% if formData['seokeyword'] is defined %}{{ formData['seokeyword'] }}{% endif %}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ 'form.content'|i18n }}</label>
                            <textarea
                                class="form-control"
                                placeholder=""
                                name="content"
                                id="summernote">{% if formData['content'] is defined %}{{ formData['content'] }}{% endif %}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ 'form.cover'|i18n }}</label>
                            <div id="uploadCover" class="dropzone" style="min-height: 240px"></div>
                            <input
                                type="hidden"
                                name="image"
                                value="{% if formData['image'] is defined %}{{ formData['image'] }}{% endif %}"
                                id="uploadCoverInput"/>
                        </div>
                        <div class="form-group">
                            <label>{{ 'form.gallery'|i18n }}</label>
                            <div id="uploadImages" class="dropzone" style="min-height: 240px"></div>
                            <div class="multipleFiles"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="javascript:;" class="btn btn-primary" id="addScnt"><i class="fa fa-plus"></i>&nbsp; {{ 'form.variant'|i18n }}</a>
                        <div id="p_scents" class="m-t-10"></div>
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

<div style="display:none" class="product-option-group">
    <select class="cs-select select-variant" name="optiongroup">
    {% for item in productOptionGroup %}
        <option value="{{ item.id }}">{{ item.name }}</option>
    {% endfor %}
    </select>
</div>
{% endblock %}
