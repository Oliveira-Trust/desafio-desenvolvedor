<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-auth" class="tocify-header">
                <li class="tocify-item level-1" data-unique="auth">
                    <a href="#auth">Auth</a>
                </li>
                                    <ul id="tocify-subheader-auth" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="auth-POSTapi-v1-login">
                                <a href="#auth-POSTapi-v1-login">User Login
This endpoint validates the user and returns an access token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="auth-POSTapi-v1-logout">
                                <a href="#auth-POSTapi-v1-logout">User Logout
This endpoint invalidates the current token and removes the user's access to the protected routes.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-instruments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="instruments">
                    <a href="#instruments">Instruments</a>
                </li>
                                    <ul id="tocify-subheader-instruments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="instruments-GETapi-v1-instruments">
                                <a href="#instruments-GETapi-v1-instruments">List Instruments</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-uploads" class="tocify-header">
                <li class="tocify-item level-1" data-unique="uploads">
                    <a href="#uploads">Uploads</a>
                </li>
                                    <ul id="tocify-subheader-uploads" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="uploads-POSTapi-v1-upload">
                                <a href="#uploads-POSTapi-v1-upload">Upload Instruments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="uploads-GETapi-v1-uploads">
                                <a href="#uploads-GETapi-v1-uploads">List Upload History</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: March 25, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="auth">Auth</h1>

    <p>Group for managing user access.</p>

                                <h2 id="auth-POSTapi-v1-login">User Login
This endpoint validates the user and returns an access token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"email@test.com\",
    \"password\": \"Password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "email@test.com",
    "password": "Password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &#039;message&#039;: &#039;Login successful&#039;,
    &#039;token&#039;: &#039;1|ouewrkj...&#039;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
     &#039;message&#039;: &#039;invalid credentials&#039;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email field is required.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-login" data-method="POST"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-login"
                    onclick="tryItOut('POSTapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-login"
                    onclick="cancelTryOut('POSTapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-login"
               value="email@test.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>email@test.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-login"
               value="Password123"
               data-component="body">
    <br>
<p>The access password. Example: <code>Password123</code></p>
        </div>
        </form>

                    <h2 id="auth-POSTapi-v1-logout">User Logout
This endpoint invalidates the current token and removes the user&#039;s access to the protected routes.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
 &#039;message&#039;: &#039;Logged out successfully&#039;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="instruments">Instruments</h1>

    <p>Group for handling the registered instruments.</p>

                                <h2 id="instruments-GETapi-v1-instruments">List Instruments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a paginated list of instruments registered in the system.
The data is cached for 60 minutes to optimize performance on repetitive queries.</p>

<span id="example-requests-GETapi-v1-instruments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/instruments?TckrSymb=PETR4&amp;RptDt=2026-03-25&amp;format=summary&amp;page=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/instruments"
);

const params = {
    "TckrSymb": "PETR4",
    "RptDt": "2026-03-25",
    "format": "summary",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-instruments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;RptDt&quot;: &quot;2026-03-25&quot;,
            &quot;TckrSymb&quot;: &quot;PETR4&quot;,
            &quot;MktNm&quot;: &quot;VISTA&quot;,
            &quot;SctyCtgyNm&quot;: &quot;A&Ccedil;&Atilde;O&quot;,
            &quot;ISIN&quot;: &quot;BRPETRACNPR6&quot;,
            &quot;CrpnNm&quot;: &quot;PETROBRAS&quot;
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 2,
    &quot;last_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=2&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/instruments?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;active&quot;: true
        }
    ],
    &quot;next_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=2&quot;,
    &quot;path&quot;: &quot;http://localhost/api/v1/instruments&quot;,
    &quot;per_page&quot;: 10,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 10,
    &quot;total&quot;: 20
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, full format):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;current_page&quot;: 1,
  &quot;data&quot;: [
    {
      &quot;id&quot;: 1,
      &quot;upload_history_id&quot;: 5,
      &quot;RptDt&quot;: &quot;2026-03-25&quot;,
      &quot;TckrSymb&quot;: &quot;PETR4&quot;,
      &quot;Asst&quot;: &quot;STOCK&quot;,
      &quot;AsstDesc&quot;: &quot;Petr&oacute;leo Brasileiro S.A.&quot;,
      &quot;SgmtNm&quot;: &quot;BOVESPA&quot;,
      &quot;MktNm&quot;: &quot;VISTA&quot;,
      &quot;SctyCtgyNm&quot;: &quot;A&Ccedil;&Atilde;O&quot;,
      &quot;XprtnDt&quot;: null,
      &quot;XprtnCd&quot;: null,
      &quot;TradgStartDt&quot;: &quot;2020-01-01&quot;,
      &quot;TradgEndDt&quot;: null,
      &quot;BaseCd&quot;: 1,
      &quot;ConvsCritNm&quot;: null,
      &quot;MtrtyDtTrgtPt&quot;: null,
      &quot;ReqrdConvsInd&quot;: null,
      &quot;ISIN&quot;: &quot;BRPETRACNPR6&quot;,
      &quot;CFICd&quot;: &quot;ESVUFR&quot;,
      &quot;DlvryNtceStartDt&quot;: null,
      &quot;DlvryNtceEndDt&quot;: null,
      &quot;OptnTp&quot;: null,
      &quot;CtrctMltplr&quot;: null,
      &quot;AsstQtnQty&quot;: null,
      &quot;AllcnRndLot&quot;: null,
      &quot;TradgCcy&quot;: &quot;BRL&quot;,
      &quot;DlvryTpNm&quot;: null,
      &quot;WdrwlDays&quot;: null,
      &quot;WrkgDays&quot;: null,
      &quot;ClnrDays&quot;: null,
      &quot;RlvrBasePricNm&quot;: null,
      &quot;OpngFutrPosDay&quot;: null,
      &quot;SdTpCd1&quot;: null,
      &quot;UndrlygTckrSymb1&quot;: null,
      &quot;SdTpCd2&quot;: null,
      &quot;UndrlygTckrSymb2&quot;: null,
      &quot;PureGoldWght&quot;: null,
      &quot;ExrcPric&quot;: null,
      &quot;OptnStyle&quot;: null,
      &quot;ValTpNm&quot;: null,
      &quot;PrmUpfrntInd&quot;: null,
      &quot;OpngPosLmtDt&quot;: null,
      &quot;DstrbtnId&quot;: null,
      &quot;PricFctr&quot;: null,
      &quot;DaysToSttlm&quot;: null,
      &quot;SrsTpNm&quot;: null,
      &quot;PrtcnFlg&quot;: null,
      &quot;AutomtcExrcInd&quot;: null,
      &quot;SpcfctnCd&quot;: null,
      &quot;CrpnNm&quot;: &quot;PETROBRAS&quot;,
      &quot;CorpActnStartDt&quot;: null,
      &quot;CtdyTrtmntTpNm&quot;: null,
      &quot;MktCptlstn&quot;: 300000000000,
      &quot;CorpGovnLvlNm&quot;: &quot;N1&quot;,
      &quot;created_at&quot;: &quot;2026-03-25T10:00:00.000000Z&quot;,
      &quot;updated_at&quot;: &quot;2026-03-25T10:00:00.000000Z&quot;
    }
  ],
  &quot;first_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=1&quot;,
  &quot;from&quot;: 1,
  &quot;last_page&quot;: 2,
  &quot;last_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=2&quot;,
  &quot;links&quot;: [...],
  &quot;next_page_url&quot;: &quot;http://localhost/api/v1/instruments?page=2&quot;,
  &quot;path&quot;: &quot;http://localhost/api/v1/instruments&quot;,
  &quot;per_page&quot;: 10,
  &quot;prev_page_url&quot;: null,
  &quot;to&quot;: 10,
  &quot;total&quot;: 20
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The RptDt field must match the format Y-m-d.&quot;,
    &quot;errors&quot;: {
        &quot;RptDt&quot;: [
            &quot;The RptDt field must match the format Y-m-d.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-instruments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-instruments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-instruments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-instruments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-instruments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-instruments" data-method="GET"
      data-path="api/v1/instruments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-instruments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-instruments"
                    onclick="tryItOut('GETapi-v1-instruments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-instruments"
                    onclick="cancelTryOut('GETapi-v1-instruments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-instruments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/instruments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-instruments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-instruments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>TckrSymb</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="TckrSymb"                data-endpoint="GETapi-v1-instruments"
               value="PETR4"
               data-component="query">
    <br>
<p>optional Filter by ticker symbol (partial match). Example: <code>PETR4</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>RptDt</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="RptDt"                data-endpoint="GETapi-v1-instruments"
               value="2026-03-25"
               data-component="query">
    <br>
<p>date optional Filter by reference date (YYYY-MM-DD). Example: <code>2026-03-25</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>format</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="format"                data-endpoint="GETapi-v1-instruments"
               value="summary"
               data-component="query">
    <br>
<p>optional Response format: "summary" (default) or "full". Example: <code>summary</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-instruments"
               value="1"
               data-component="query">
    <br>
<p>optional Page number for pagination. Example: <code>1</code></p>
            </div>
                </form>

                <h1 id="uploads">Uploads</h1>

    <p>Group for handling the instruments upload.</p>

                                <h2 id="uploads-POSTapi-v1-upload">Upload Instruments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint receives the file, verifies if it's a valid document, if the reference date matches the file, and runs background jobs to save the data. Finally, it sends an email informing the upload status.</p>

<span id="example-requests-POSTapi-v1-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/v1/upload" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "reference_date=2026-03-22"\
    --form "file=@/tmp/phpq375u6pck1jr59eujWv" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/upload"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('reference_date', '2026-03-22');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-upload">
            <blockquote>
            <p>Example response (202):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;File received and being processed; you will be notified by email upon completion.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Date mismatch: File is for 2026-01-01, but reference date is 2026-03-23.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-upload"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-upload">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-upload" data-method="POST"
      data-path="api/v1/upload"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-upload"
                    onclick="tryItOut('POSTapi-v1-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-upload"
                    onclick="cancelTryOut('POSTapi-v1-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-upload"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/upload</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-upload"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-upload"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="POSTapi-v1-upload"
               value=""
               data-component="body">
    <br>
<p>The instruments file from B3 (CSV, XLSX) Example: <code>/tmp/phpq375u6pck1jr59eujWv</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reference_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference_date"                data-endpoint="POSTapi-v1-upload"
               value="2026-03-22"
               data-component="body">
    <br>
<p>The reference date for the file data (YYYY-MM-DD). Example: <code>2026-03-22</code></p>
        </div>
        </form>

                    <h2 id="uploads-GETapi-v1-uploads">List Upload History</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns a paginated list of uploads.
The data is cached for 30 minutes to optimize performance on repetitive queries.</p>

<span id="example-requests-GETapi-v1-uploads">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/uploads?file_name=report&amp;reference_date=2026-03-24&amp;page=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/uploads"
);

const params = {
    "file_name": "report",
    "reference_date": "2026-03-24",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-uploads">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 2,
            &quot;file_name&quot;: &quot;Instruments_20260324.csv&quot;,
            &quot;reference_date&quot;: &quot;2026-03-24&quot;,
            &quot;status&quot;: &quot;completed&quot;,
            &quot;total_rows&quot;: 120879,
            &quot;created_at&quot;: &quot;2026-03-24T22:08:44.000000Z&quot;
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/v1/uploads?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://localhost/api/v1/uploads?page=1&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/uploads?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://localhost/api/v1/uploads&quot;,
    &quot;per_page&quot;: 10,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 1,
    &quot;total&quot;: 1
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The reference date field must match the format Y-m-d.&quot;,
    &quot;errors&quot;: {
        &quot;reference_date&quot;: [
            &quot;The reference date field must match the format Y-m-d.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-uploads" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-uploads"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-uploads"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-uploads" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-uploads">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-uploads" data-method="GET"
      data-path="api/v1/uploads"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-uploads', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-uploads"
                    onclick="tryItOut('GETapi-v1-uploads');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-uploads"
                    onclick="cancelTryOut('GETapi-v1-uploads');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-uploads"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/uploads</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-uploads"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-uploads"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>file_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="file_name"                data-endpoint="GETapi-v1-uploads"
               value="report"
               data-component="query">
    <br>
<p>Partial filter by file name. Example: <code>report</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>reference_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reference_date"                data-endpoint="GETapi-v1-uploads"
               value="2026-03-24"
               data-component="query">
    <br>
<p>date Filter by reference date. (YYYY-MM-DD). Example: <code>2026-03-24</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-uploads"
               value="1"
               data-component="query">
    <br>
<p>Page number for pagination. Example: <code>1</code></p>
            </div>
                </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
