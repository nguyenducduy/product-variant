{% extends "../../Core/View/Layout/Default/admin-main.volt" %}

{% block title %}
    {{ 'page-title-index'|i18n }} | {{ config.global.title }}
{% endblock %}

{% block css %}
    <link href="{{ static_url('min/index.php?g=cssDefaultProductAdmin&rev=' ~ config.global.version.css) }}" rel="stylesheet" type="text/css">
{% endblock %}

{% block js %}
    <script type="text/javascript" src="{{ static_url('min/index.php?g=jsDefaultProductAdmin&rev=' ~ config.global.version.js) }}"></script>
{% endblock %}

{% block content %}
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg bg-white" rel="user-admin">
    <!-- BEGIN PlACE PAGE CONTENT HERE -->
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="btn-group pull-right m-b-10">
                  <a href="{{ url('admin/product/create') }}" class="btn btn-complete"><i class="fa fa-plus"></i>&nbsp; {{ 'default.button-create'|i18n }}</a>
                </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            {{ content() }}
            <div class="table-responsive">
                <form method="post" action="">
                <input type="hidden" name="{{ security.getTokenKey() }}" value="{{ security.getToken() }}" />
                <table class="table table-hover table-condensed" id="basicTable">
                    <thead>
                        <tr>
                            <th style="width:7%">
                                <div class="checkbox check-danger">
                                  <input type="checkbox" value="checkall" id="checkall" class="check-all">
                                  <label for="checkall"></label>
                                </div>
                            </th>
                            <th style="width:50%">{{ 'th.name'|i18n }}</th>
                            <th style="width:14%">
                                {{ 'th.vendorprice'|i18n }}
                            </th>
                            <th style="width:14%">
                                {{ 'th.sellprice'|i18n }}
                            </th>
                            <th style="width:10%">
                                <a href="{{ url.getBaseUri() }}admin/product?orderby=status&ordertype={% if formData['orderType']|lower == 'desc'%}asc{% else %}desc{% endif %}{% if formData['conditions']['keyword'] != '' %}&keyword={{ formData['conditions']['keyword'] }}{% endif %}">
                                    {{ 'th.status'|i18n }}
                                </a>
                            </th>
                            <th style="width:15%"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <div class="bulk-actions">
                                    <select
                                        class="cs-select cs-skin-slide"
                                        data-init-plugin="cs-select"
                                        name="fbulkaction">
                                        <option value="">{{ 'default.select-action'|i18n }}</option>
                                        <option value="delete">{{ 'default.select-delete'|i18n }}</option>
                                    </select>
                                    <input type="submit" name="fsubmitbulk" class="btn btn-primary" value="{{ 'default.button-submit-bulk'|i18n }}" />
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody>
                    {% for item in myProducts.items %}
                        <tr>
                            <td class="v-align-middle">
                                <input type="checkbox" name="fbulkid[]" value="{{ item.id }}" {% if formData['fbulkid'] is defined %}{% for key, value in formData['fbulkid'] if value == item.id %}checked="checked"{% endfor %}{% endif %} id="checkbox{{ item.id }}"/>
                            </td>
                            <td class="v-align-middle">
                                <small class="pull-right">
                                    <i class="fa fa-fire"></i>&nbsp;<a href="#" class="ishot" data-name="ishot" data-type="select" data-pk="{{ item.id }}" data-value="{{ item.ishot }}"></a> &nbsp;
                                    <i class="fa fa-star"></i>&nbsp;<a href="#" class="isnew" data-name="isnew" data-type="select" data-pk="{{ item.id }}" data-value="{{ item.isnew }}"></a> &nbsp; | &nbsp;
                                    <a href="javascript:;" class="showVariant" id="{{ item.id }}">Xem/Sửa biến thể</a>
                                </small>
                                <img src="{{ static_url(item.getThumbnailImage()) }}" class="img-rounded" alt="{{ item.getThumbnailImage() }}" width="60" height="60">
                                <small class="img-left-blk">
                                    <span class="label label-success">{{ item.barcode }}</span> <br/>
                                    <strong>{{ item.name }}</strong> <br/>
                                    Số lượng còn: <span class="badge badge-default" id="quantity_{{ item.id }}">{{ item.quantity }}<br/>
                                </small>
                            </td>
                            <td>
                                {{ number_format(item.vendorprice) }} &#8363;
                            </td>
                            <td>
                                <span class="text-danger">{{ number_format(item.sellprice) }} &#8363;</span>
                            </td>
                            <td class="v-align-middle"><span class="{{ item.getStatusStyle() }}">{{ item.getStatusName()|i18n }}</span></td>
                            <td class="v-align-middle">
                                <div class="btn-group btn-group-xs pull-right">
                                    <a href="{{ url('admin/product/edit/' ~ item.id) }}" class="btn btn-default"><i class="fa fa-pencil"></i>&nbsp; {{ 'td.edit'|i18n }}</a>
                                    <a href="javascript:deleteConfirm('{{ url('admin/product/delete/' ~ item.id) }}', '{{ item.id }}');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <div class="pull-right">
        {% if paginator.items is defined and paginator.total_pages > 1 %}
            {% include "../../Core/View/Layout/Default/admin-paginator.volt" %}
        {% endif %}
        </div>
    </div>
    <!-- END PANEL -->
    <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
    <div class="row">
        <div class="col-md-6">&nbsp;</div>
    </div>
</div>
{% include "../../Product/View/Admin/Default/modal.volt" %}
<style media="screen">
    .optionCover {
        width: 80px;
        height: 80px;
    }
     .dropzone {
        height: 80px;
        padding: 0px !important;
    }
     .dropzone .dz-preview, .dropzone-previews .dz-preview {
        padding: 0px !important;
        margin: 0px !important;
        width: 80px !important;
        height: 80px !important;
        font-size: 11px;
    }
     .dropzone .dz-preview .dz-details img, .dropzone-previews .dz-preview .dz-details img {
        width: 80px;
        height: 80px;
    }
     .dropzone .dz-preview .dz-details .dz-size, .dropzone-previews .dz-preview .dz-details .dz-size {
        bottom: 0px;
        left: 0px;
        line-height: 0;
    }
     .dropzone .dz-preview .dz-details .dz-filename, .dropzone-previews .dz-preview .dz-details .dz-filename {
        height: 20px;
    }
     .dropzone .dz-preview .dz-success-mark, .dropzone-previews .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-error-mark, .dropzone-previews .dz-preview .dz-error-mark {
        right: 0;
        top: -3px;
    }
     .dropzone a.dz-remove, .dropzone-previews a.dz-remove {
        margin-top: -22px;
        width: 78px;
        border-radius: 0px;
        font-size: 10px;
    }
    .dropzone .dz-preview .dz-progress, .dropzone-previews .dz-preview .dz-progress {
        top: 45px;
    }
    .dropzone .dz-preview .dz-details, .dropzone-previews .dz-preview .dz-details {
        height: 53px;
    }
    .dropzone .dz-default.dz-message {
        top: 22%;
        left: 42%;
        display: block;
        margin-left: -14px;
        margin-top: -8px;
    }
    .dropzone .dz-default.dz-message span {
        display: block;
        font-size: 40px;
    }

</style>
{% endblock %}
