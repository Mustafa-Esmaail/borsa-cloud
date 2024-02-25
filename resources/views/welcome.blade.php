<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- SEO Meta Tags -->
    <meta
      name="description"
      content="Borsa Cloud is a HTML landing page template built with Bootstrap to help you crate engaging presentations for SaaS apps and convert visitors into users."
    />
    <meta name="author" content="Inovatik" />

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" />
    <!-- website name -->
    <meta property="og:site" content="" />
    <!-- website link -->
    <meta property="og:title" content="" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" />
    <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Borsa Cloud</title>

    <!-- Styles -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
      rel="stylesheet"
    />

    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/fontawesome-all.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/swiper.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/css/styles.css') }}" rel="stylesheet" />

    <!-- Favicon  -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon-16x16.png') }}">
       <link rel="icon" href="{{ asset('public/assets/images/favicon.png') }}" />

    <link rel="manifest" href="{{ asset('public/assets/images/site.webmanifest') }} ">
  
  </head>
  <body data-spy="scroll" data-target=".fixed-top">
    <!-- Preloader -->
    <div class="spinner-wrapper">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
    <!-- end of preloader -->

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

        <!-- Image Logo -->
        <a class="navbar-brand logo-image" href="index.html"
          ><img src="{{ asset('public/assets/images/logo.png') }}" alt="alternative"
        /></a>
        

        <!-- Mobile Menu Toggle Button -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarsExampleDefault"
          aria-controls="navbarsExampleDefault"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-awesome fas fa-bars"></span>
          <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav ml-auto">
            <li  class="nav-item headerText">
              <a class="nav-link page-scroll" href="#header"
                >من نحن  <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item headerText">
              <a class="nav-link page-scroll" href="#features">المميزات</a>
            </li>
            <li class="nav-item headerText">
              <a class="nav-link page-scroll" href="#details">لماذا بورصا كلاودز</a>
            </li>
            <li class="nav-item headerText">
              <a class="nav-link page-scroll" href="#details">تحميل</a>
            </li>

          </ul>
        </div>
      </div>
      <!-- end of container -->
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header">
      <div class="header-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-xl-5">
              <div class="text-container">
                <h1 style="text-align: start">بورصا كلاودز</h1>
                <p style="text-align: start" class="p-large">
                  نقدم لكم حلاً متكاملاً الحسابات  المكاتب بشكل فعّال
                  وآمن. سواء كنتم تقومون بإرسال أموال أو استلامها، يوفر تطبيقنا
                  واجهة سهلة الاستخدام وميزات قوية لتسهيل عمليات التحويل وتتبع
                  جميع الحركات المالية داخل المكتب.
                </p>
                >
              </div>
              <!-- end of text-container -->
            </div>
            <!-- end of col -->
            <div class="col-lg-6 col-xl-7">
              <div class="image-container">
                <div class="img-wrapper">
                  <img
                    class="img-fluid"
                    src="{{ asset('public/assets/images/header-software-app.png') }}"
                    alt="alternative"
                  />
                </div>
                <!-- end of img-wrapper -->
              </div>
              <!-- end of image-container -->
            </div>
            <!-- end of col -->
          </div>
          <!-- end of row -->
        </div>
        <!-- end of container -->
      </div>
      <!-- end of header-content -->
    </header>
    <!-- end of header -->
    <svg
      class="header-frame"
      data-name="Layer 1"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="none"
      viewBox="0 0 1920 310"
    >
      <defs>
        <style>
          .cls-1 {
            fill: #3f72af;
          }
        </style>
      </defs>
      <title>header-frame</title>
      <path
        class="cls-1"
        d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"
      />
    </svg>
    <!-- end of header -->

    <!-- Description -->
    <div class="cards-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="h2-heading">تحويلات مالية سريعة وآمنة</h2>
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
        <div class="row">
          <div class="col-lg-12">
            <!-- Card -->
            <div class="card">
              <div class="card-image">
                <img
                  class="img-fluid"
                  src="{{ asset('public/assets/images/description-1.png') }}"
                  alt="alternative"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">تحويلات مالية سريعة وآمنة</h4>
                <p>
                  قم بإرسال واستلام الأموال بشكل فوري وآمن، دون الحاجة إلى
                  الاعتماد على وسائل التحويل التقليدية.
                </p>
              </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
              <div class="card-image">
                <img
                  class="img-fluid"
                  src="{{ asset('public/assets/images/description-2.png') }}"
                  alt="alternative"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">تتبع الحركات المالية</h4>
                <p>
                  تابع جميع التحويلات النقدية والمدفوعات الخارجية والواردة
                  بسهولة من خلال لوحة التحكم المتقدمة.
                </p>
              </div>
            </div>
            <!-- end of card -->

            <!-- Card -->
            <div class="card">
              <div class="card-image">
                <img
                  class="img-fluid"
                  src="{{ asset('public/assets/images/description-3.png') }}"
                  alt="alternative"
                />
              </div>
              <div class="card-body">
                <h4 class="card-title">تقارير مالية مخصصة</h4>
                <p>
                  استفد من تقارير مالية دقيقة ومخصصة تتيح لك فهم أفضل لمصروفات
                  المكتب وإيراداته.
                </p>
              </div>
            </div>
            <!-- end of card -->
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of cards-1 -->
    <!-- end of description -->

    <!-- Features -->
    <div id="features" class="tabs">
      <div class="container">
        <div class="row">
          <!-- end of col -->
        </div>
        <!-- end of row -->
        <div class="row">
          <div class="col-lg-12">
            <!-- Tabs Links -->
            <ul class="nav nav-tabs" id="argoTabs" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="nav-tab-1"
                  data-toggle="tab"
                  href="#tab-1"
                  role="tab"
                  aria-controls="tab-1"
                  aria-selected="true"
                  ><i class="fas fa-list"></i>لوحة تحكم</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="nav-tab-2"
                  data-toggle="tab"
                  href="#tab-2"
                  role="tab"
                  aria-controls="tab-2"
                  aria-selected="false"
                  ><i class="fas fa-envelope-open-text"></i>الدردشات</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="nav-tab-3"
                  data-toggle="tab"
                  href="#tab-3"
                  role="tab"
                  aria-controls="tab-3"
                  aria-selected="false"
                  ><i class="fas fa-chart-bar"></i>سوق العملات</a
                >
              </li>
            </ul>
            <!-- end of tabs links -->

            <!-- Tabs Content -->
            <div class="tab-content" id="argoTabsContent">
              <!-- Tab -->
              <div
                class="tab-pane fade show active"
                id="tab-1"
                role="tabpanel"
                aria-labelledby="tab-1"
              >
                <div class="row">
                  <div class="col-lg-6">
                    <div class="image-container">
                      <img
                        class="img-fluid"
                        src="{{ asset('public/assets/images/features-1.png') }}"
                        alt="alternative"
                      />
                    </div>
                    <!-- end of image-container -->
                  </div>
                  <!-- end of col -->
                  <div class="col-lg-6">
                    <div class="text-container">
                      <h3>لوحة التحكم</h3>

                      <p>
                        استمتع بتجربة ادارة حسابات متقدمة مع لوحة تحكم تتيح لك
                        رؤية شاملة لجميع العمليات المالية داخل المكتب. قم
                        بمتابعة الحسابات، وتحليل التقارير، وتصنيف المعاملات
                        بسهولة.
                      </p>
                      <ul class="list-unstyled li-space-lg">
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            إدارة فعّالة للحسابات: توفير رؤية فورية وشاملة لحالة
                            حساباتكم مع ميزة تحليل الأنشطة المالية بسرعة وسهولة.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            تقارير مالية دقيقة: استفيدوا من تقارير مخصصة تمكنكم
                            من فحص النفقات والإيرادات بشكل مفصل، مما يسهل اتخاذ
                            القرارات المستنيرة.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            تصنيف المعاملات: قم بتنظيم المعاملات وتصنيفها حسب
                            الأقسام والمشاريع لتحقيق فحص أكثر دقة وفعالية لسجلات
                            الأموال.
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- end of text-container -->
                  </div>
                  <!-- end of col -->
                </div>
                <!-- end of row -->
              </div>
              <!-- end of tab-pane -->
              <!-- end of tab -->

              <!-- Tab -->
              <div
                class="tab-pane fade"
                id="tab-2"
                role="tabpanel"
                aria-labelledby="tab-2"
              >
                <div class="row">
                  <div class="col-lg-6">
                    <div class="image-container">
                      <img
                        class="img-fluid"
                        src="{{ asset('public/assets/images/features-2.png') }}"
                        alt="alternative"
                      />
                    </div>
                    <!-- end of image-container -->
                  </div>
                  <!-- end of col -->
                  <div class="col-lg-6">
                    <div class="text-container">
                      <h3>الدردشات</h3>
                      <p>
                        قدّمنا لكم ميزة الدردشات لتسهيل التواصل داخل التطبيق.
                        تواصلوا بشكل مباشر مع أعضاء الفريق، قدموا التفاصيل
                        المالية بشكل أسرع، واحصلوا على ردود فورية.
                      </p>
                      <ul class="list-unstyled li-space-lg">
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            تواصل فعّال: قدموا الدعم والإرشادات المالية على
                            الفور من خلال المحادثات الفعّالة داخل التطبيق، مما
                            يساعد على تسريع عمليات الاتخاذ القرارات.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            توفير الوقت: تفادوا التبديل بين تطبيقات الدردشة
                            الخارجية، وقدموا المعلومات المالية بسرعة وسهولة داخل
                            بيئة واحدة.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            تواصل آمن: احصلوا على ميزة الدردشات المشفرة لضمان
                            أمان المحتوى المالي والبيانات الحساسة.
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- end of text-container -->
                  </div>
                  <!-- end of col -->
                </div>
                <!-- end of row -->
              </div>
              <!-- end of tab-pane -->
              <!-- end of tab -->

              <!-- Tab -->
              <div
                class="tab-pane fade"
                id="tab-3"
                role="tabpanel"
                aria-labelledby="tab-3"
              >
                <div class="row">
                  <div class="col-lg-6">
                    <div class="image-container">
                      <img
                        class="img-fluid"
                        src="{{ asset('public/assets/images/features-3.png') }}"
                        alt="alternative"
                      />
                    </div>
                    <!-- end of image-container -->
                  </div>
                  <!-- end of col -->
                  <div class="col-lg-6">
                    <div class="text-container">
                      <h3>سوق العملات</h3>
                      <p>
                        اكتسبوا تحكمًا أكبر في أموالكم من خلال دمج سوق العملات
                        داخل التطبيق. قوموا بمراقبة التحولات العملية واتخاذ
                        القرارات المالية الذكية باستخدام بيانات السوق في الوقت
                        الحقيقي.
                      </p>
                      <ul class="list-unstyled li-space-lg">
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            متابعة الأسواق في الوقت الحقيقي: استفيدوا من بيانات
                            السوق الحية لاتخاذ قرارات مالية مستنيرة في الوقت
                            الفعلي.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            فحص التحولات المالية: تمتعوا برؤية فورية لتقلبات
                            السوق وضبطوا استراتيجياتكم المالية بناءً على
                            المعلومات الأحدث.
                          </div>
                        </li>
                        <li class="media">
                          <i class="fas mx-2 fa-square"></i>
                          <div class="media-body">
                            إمكانية الاستثمار الذكية: استخدموا بيانات السوق
                            لاتخاذ قرارات استثمارية ذكية ومحسّنة لتحقيق أقصى
                            استفادة من أموالكم.
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- end of text-container -->
                  </div>
                  <!-- end of col -->
                </div>
                <!-- end of row -->
              </div>
              <!-- end of tab-pane -->
              <!-- end of tab -->
            </div>
            <!-- end of tab content -->
            <!-- end of tabs content -->
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of tabs -->
    <!-- end of features -->

    <!-- Details Lightboxes -->
    <!-- Details Lightbox 1 -->
    <div
      id="details-lightbox-1"
      class="lightbox-basic zoom-anim-dialog mfp-hide"
    >
      <div class="container">
        <div class="row">
          <button title="Close (Esc)" type="button" class="mfp-close x-button">
            ×
          </button>
          <div class="col-lg-8">
            <div class="image-container">

            </div>
            <!-- end of image-container -->
          </div>
          <!-- end of col -->

          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of lightbox-basic -->
    <!-- end of details lightbox 1 -->

    <!-- Details Lightbox 2 -->
    <div
      id="details-lightbox-2"
      class="lightbox-basic zoom-anim-dialog mfp-hide"
    >

      <!-- end of container -->
    </div>
    <!-- end of lightbox-basic -->
    <!-- end of details lightbox 2 -->

    <!-- Details Lightbox 3 -->
    <div
      id="details-lightbox-3"
      class="lightbox-basic zoom-anim-dialog mfp-hide"
    >
      <div class="container">
        <div class="row">
          <button title="Close (Esc)" type="button" class="mfp-close x-button">
            ×
          </button>
          <div class="col-lg-8">
            <div class="image-container">
              <img
                class="img-fluid"
                src="{{ asset('public/assets/images/details-lightbox.png') }}"
                alt="alternative"
              />
            </div>
            <!-- end of image-container -->
          </div>
          <!-- end of col -->
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of lightbox-basic -->
    <!-- end of details lightbox 3 -->
    <!-- end of details lightboxes -->

    <!-- Details -->
    <div id="details" class="basic-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="text-container">
              <h2>احصلوا على تجربة حسابات الأموال المثلى</h2>
              <p>
                تجمع التحكم المتقدم بالسهولة: مع لوحة تحكم متطورة وميزات فريدة،
                ستجدون الراحة في إدارة أموالكم بشكل فعّال.
              </p>
              <ul class="list-unstyled li-space-lg">
                <li class="media">
                  <i class="mx-2 fas mx-2 fa-square"></i>
                  <div class="media-body">
                    تواصل مستمر: استمتعوا بالتواصل المستمر والفعّال مع الدردشات
                    المدمجة، مما يجعل تبادل المعلومات المالية أسهل من أي وقت
                    مضى.
                  </div>
                </li>
                <li class="media">
                  <i class=" mx-2 fas mx-2 fa-square"></i>
                  <div class="media-body">
                    تحقيق أرباح أكبر: من خلال سوق العملات المدمج، استفيدوا من
                    بيانات السوق لاتخاذ قرارات استثمارية ذكية وتحقيق أقصى عائد.
                  </div>
                </li>
              </ul>
            </div>
            <!-- end of text-container -->
          </div>
          <!-- end of col -->
          <div class="col-lg-6">
            <div class="image-container">
              <img
                class="img-fluid"
                src="{{ asset('public/assets/images/details.png') }}"
                alt="alternative"
              />
            </div>
            <!-- end of image-container -->
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of basic-1 -->
    <!-- end of details -->

    <!-- Video -->
    <div id="video" class="basic-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="mb-5"> يمكنك التحميل علي  </h1>
            <!-- Video Preview -->
  <div class="d-flex justify-content-center flex-wrap align-items-center text-center">
  <img class="mt-3 mx-3 downloadImg" src="{{ asset('public/assets/images/windows-22.png') }}" alt="">
  <img class="mt-3 mx-3 downloadImg" src="{{ asset('public/assets/images/andriod.png') }}" alt="">
  <img class="mt-3 mx-3 downloadImg" src="{{ asset('public/assets/images/IOS.png') }}" alt="">


</div>
            <!-- end of image-container -->
            <!-- end of video preview -->
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of basic-2 -->
    <!-- end of video -->

    <!-- Pricing -->

    <!-- end of cards-2 -->
    <!-- end of pricing -->

    <!-- Testimonials -->

    <!-- end of slider-2 -->
    <!-- end of testimonials -->

    <!-- Newsletter -->

    <!-- end of form -->
    <!-- end of newsletter -->

    <!-- Footer -->
    <svg
      class="footer-frame"
      data-name="Layer 2"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="none"
      viewBox="0 0 1920 79"
    >
      <defs>
        <style>
          .cls-2 {
            fill: #3f72af;
          }
        </style>
      </defs>
      <title>footer-frame</title>
      <path
        class="cls-2"
        d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z"
        transform="translate(0 -0.188)"
      />
    </svg>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="footer-col first">
              <h4>بورصا كلاودز</h4>
              <p class="p-small">
                نقدم لكم حلاً متكاملاً لإدارة الأموال في المكاتب بشكل فعّال وآمن. سواء كنتم تقومون بإرسال أموال أو استلامها، يوفر تطبيقنا واجهة سهلة الاستخدام
              </p>
            </div>
          </div>
          <!-- end of col -->
          <!-- end of col -->
          <div class="col-md-6">
            <div class="footer-col last">
              <h4>تواصل</h4>
              <ul class="list-unstyled li-space-lg p-small">
                <li class="media">
                  <i class="fas fa-map-marker-alt"></i>
                  <div class="media-body">
                    اذا كان لديك اي استفسار يمكنك التواصل معنا علي
                  </div>
                </li>
                <li class="media">
                  <i class="fas fa-envelope"></i>
                  <div class="media-body">
                    <a class="white" href="mailto:info@borsacloud.com"
                      >info@boraclouds.com</a
                    >
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- end of col -->
        </div>
        <!-- end of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of footer -->
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <p class="p-small">
              Copyright © 2024
              <a href="https://borsacloud.com">Borsa Clouds</a>
            </p>
          </div>
          <!-- end of col -->
        </div>
        <!-- enf of row -->
      </div>
      <!-- end of container -->
    </div>
    <!-- end of copyright -->
    <!-- end of copyright -->

    <!-- Scripts -->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
    <!-- Popper tooltip library for Bootstrap -->
    <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap framework -->
    <script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>
    <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{ asset('public/assets/js/swiper.min.js') }}"></script>
    <!-- Swiper for image and text sliders -->
    <script src="{{ asset('public/assets/js/jquery.magnific-popup.js') }}"></script>
    <!-- Magnific Popup for lightboxes -->
    <script src="{{ asset('public/assets/js/validator.min.js') }}"></script>
    <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <!-- Custom scripts -->
  </body>
</html>
