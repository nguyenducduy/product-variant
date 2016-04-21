{% extends "../../Core/View/Layout/Default/admin-main.volt" %}

{% block title %}
    {{ 'page-title-dashboard'|i18n }} | {{ config.global.title }}
{% endblock %}

{% block content %}
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg bg-white">
    <div class="panel panel-transparent">
        <div class="panel-body">
            <div class="col-md-8">
              <div class="panel panel-transparent">
                <div class="panel-heading">
                  <div class="panel-title">{{ 'panel-title-overview'|i18n }}
                  </div>
                </div>
                <div class="panel-body">
                  <p>
                      <ul>
                          <li>Server: {{ request.getServerAddress()}}</li>
                          <li>Client: {{ request.getClientAddress()}}</li>
                          <li>Charset: {{ request.getBestCharset()}}</li>
                          <li>Language: {{ request.getBestLanguage()}}</li>
                          <li>User Agent: {{ request.getUserAgent()}}</li>
                      </ul>

                  </p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER FLUID -->
{% endblock %}
