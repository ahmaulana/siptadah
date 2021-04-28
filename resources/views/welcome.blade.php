<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPTADAHAN | Pengadilan Negeri Kendal</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('img/logo-utama.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.css') }}">

    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nivo-lightbox/nivo-lightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nivo-lightbox/default.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <!-- Navigation
    ==========================================-->
    <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <!--<img src="img/logo.png" class="img-responsive" alt="" style="width:250px;height:90px;"> -->
                <a class="navbar-brand page-scroll" href="#page-top">Siptadahan | PN KENDAL</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#features" class="page-scroll">Pelayanan</a></li>
                    <li><a href="#about" class="page-scroll">Tentang Kami</a></li>
                    <li><a href="#services" class="page-scroll">Tahap</a></li>
                    <li><a href="#portfolio" class="page-scroll">Galeri</a></li>
                    <li><a href="#contact" class="page-scroll">Kontak</a></li>
                    <li><a href="{{ route('login') }}" role="button"><strong>Login Disini</strong></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- Header -->
    <header id="header">
        <div class="intro">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 intro-text">
                            <h1>SIPTADAHAN<span></span></h1>
                            <p>Sistem Informasi Permohonan / Perijinan Sita Geledah dan Perpanjangan Tahanan.</p>
                            <a href="#features" class="btn btn-custom btn-lg page-scroll">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Features Section -->
    <div id="features" class="text-center">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 section-title">
                <h2>Pelayanan</h2>
            </div>
            <div class="row">

                <div class="col-xs-10 col-md-6"> <i class="fa fa-university"></i>
                    <h3>Permohonan Sita Geledah</h3>
                    <p>Penyitaan dan Penggeledahan merupakan suatu tindakan para penyidik untuk mengambil alih kekuasaan benda serta mendatangi dan melakukan aktivitas inspeksi atau penggeledahan di kediaman yang bersangkutan untuk dijadikan sebagai bukti penyelidikan serta penggungatan di lembaga hukum yaitu Pengadilan Negeri Kendal.</p>
                </div>
                <div class="col-xs-10 col-md-6"> <i class="fa fa-gavel"></i>
                    <h3>Perpanjangan Tahanan</h3>
                    <p>Perpanjangan tahanan digunakan untuk pemeriksaan lebih dalam atas kasus yang dilakukan oleh tersangka, kemudian penyidik ketika memeriksa tersangka tersebut belum selesai atau sudah melewati batas penetapan, maka penyidik harus memperpanjang tahanan tersebut dengan melengkapi dokumen – dokumen sesuai aturan di Pengadilan Negeri </p>
                </div>

            </div>
        </div>
    </div>
    <!-- About Section -->
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6"> <img src="{{ asset('img/siptadahan.jpg') }}" class="img-responsive" alt=""> </div>
                <div class="col-xs-12 col-md-6">
                    <div class="about-text">
                        <h2>Tentang Kami</h2>
                        <p align="justify"><b>SIPTADAHAN</b> (Sistem Informasi Permohonan/Perijinan Sita Geledah dan Perpanjangan Tahanan dibuat untuk mempermudah dan mempercepat proses permohonan Penetapan Ketua Pengadilan Negeri Kendal terkait "Persetujuan atau Izin Sita - Geledah dan Perpanjangan Tahanan"</p>
                        <center>
                            <p><i><b>"Diharapkan saudara dapat mengisi formulir online ini untuk data acuan kelengkapan berkas saudara sebelum mengajukan permohonan. Atas perhatian Bapak/Ibu kami sampaikan terimakasih"</b></i></p>
                        </center>
                        <center>
                            <p><b>- Kepaniteraan Pidana Pengadilan Negeri Kendal -</b></p>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Services Section -->
    <div id="services" class="text-center">
        <div class="container">
            <div class="section-title">
                <h2>Tahap Proses Pengajuan</h2>
                <p>Berikut ini merupakan gambaran tentang tahap - tahap proses pengajuan Sistem Permohonan Sita Geledah dan Perpanjangan Tahanan (SIPTADAHAN).</p>
            </div>
            <div class="row">
                <div class="col-sm-15 col-md-15 col-lg-15">
                    <b>
                        <h3>Proses Pengajuan Sita Geledah</h3>
                    </b>
                    <div class="portfolio-item">
                        <div class="hover-bg"> <a href="{{ asset('img/bpmnsg.png') }}" title="Proses Sita Geledah">
                                <div class="hover-text">
                                    <h4>Proses Sita Geledah</h4>
                                </div>
                                <img src="{{ asset('img/bpmnsg.png') }}" class="img-responsive" alt="Proses Sita Geledah">
                            </a> </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-15 col-md-15 col-lg-15">
                    <b>
                        <h3>Proses Pengajuan Perpanjangan Tahanan</h3>
                    </b>
                    <div class="portfolio-item">
                        <div class="hover-bg"> <a href="{{ asset('img/bpmnpt.png') }}" title="Proses Perpanjangan Tahanan">
                                <div class="hover-text">
                                    <h4>Proses Perpanjangan Tahanan</h4>
                                </div>
                                <img src="{{ asset('img/bpmnpt.png') }}" class="img-responsive" alt="Proses Perpanjangan Tahanan">
                            </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Section -->
    <div id="portfolio" class="text-center">
        <div class="container">
            <div class="section-title">
                <h2>Galeri Pengadilan Negeri Kendal</h2>
                <p>Lingkungan dan Kegiatan Pengadilan Negeri Kendal Kelas I B.</p>
            </div>
            <div class="row">
                <div class="portfolio-items">
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn1.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn1.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn2.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn2.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn3.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn3.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn4.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn4.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn5.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn5.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn6.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn6.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn7.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn7.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn8.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn8.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="portfolio-item">
                            <div class="hover-bg"> <a href="{{ asset('img/pn9.jpeg') }}" title="PN Kendal Kelas I B" data-lightbox-gallery="gallery1">
                                    <div class="hover-text">
                                        <h4>PN Kendal Kelas I B</h4>
                                    </div>
                                    <img src="{{ asset('img/pn9.jpeg') }}" class="img-responsive" alt="PN Kendal Kelas I B">
                                </a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact">
        <div class="container">
            <div class="col-md-8">
                <div class="row">
                    <div class="section-title">
                        <h2>Kontak Kami</h2>
                        <p>Silakan isi formulir di bawah ini untuk mengirimkan email kepada kami dan kami akan segera menghubungi Anda.</p>
                    </div>
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="name" class="form-control" placeholder="Name" required="required">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div id="success"></div>
                        <button type="submit" class="btn btn-custom btn-lg">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1 contact-info">
                <div class="contact-item">
                    <h3>Info Kontak</h3>
                    <p align="justify"><span><i class="fa fa-map-marker"></i> Alamat</span>Jl. Raya Soekarno-Hatta No.220, Patukangan, Pegulon, Kec. Kendal, Kabupaten Kendal, Jawa Tengah 51318,<br></p>
                </div>
                <div class="contact-item">
                    <p><span><i class="fa fa-phone"></i> Telepon</span> (0294) 381479</p>
                </div>
                <div class="contact-item">
                    <p><span><i class="fa fa-envelope-o"></i> Email</span>pnkendal@yahoo.co.id</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="social">
                        <ul>
                            <li><a href="https://www.facebook.com/pengadilan.kendal"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/humaspnkendal/?hl=en"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCAvBbvYQ4nyoCGlbCWu3LaQ"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Section -->
    <div id="footer">
        <div class="container text-center">
            <p>&copy; SIPTADAHAN. All rights reserved | Design by TIM IT PN KENDAL & TATAS</a></p>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.1.11.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/SmoothScroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/nivo-lightbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/contact_me.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>