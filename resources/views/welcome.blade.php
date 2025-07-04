@extends('master')
@section('title')
Accueil
@endsection

@section('extra-style')

@endsection
@section('content')
<section class="section main-banner" id="top" data-section="section1">
    <video autoplay muted loop id="bg-video">
        <source src="assets/images/course-video.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="caption">
            <h2>Bienvenue à l'ANEEPES</h2>
            <p>L'<strong>ANEEPES</strong> (Association Nationale des Etudiants des Etablissement Privés de l'Enseignement Supérieur) est un mouvement d'étudiant regroupant les étudiants et stagiaires inscrits dans les établissements de l'enseignement supérieur privé du Bénin.</p>
            <div class="main-button-red">
                <div class="scroll-to-section"><a href="{{route('register')}}">Nous rejoindre</a></div>
            </div>
        </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- ***** Main Banner Area End ***** -->

<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-service-item owl-carousel">
        
          <div class="item">
            <div class="icon">
              <img src="assets/images/service-icon-01.png" alt="">
            </div>
            <div class="down-content">
              <h4>Best Education</h4>
              <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
            </div>
          </div>
          
          <div class="item">
            <div class="icon">
              <img src="assets/images/service-icon-02.png" alt="">
            </div>
            <div class="down-content">
              <h4>Best Teachers</h4>
              <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
            </div>
          </div>
          
          <div class="item">
            <div class="icon">
              <img src="assets/images/service-icon-03.png" alt="">
            </div>
            <div class="down-content">
              <h4>Best Students</h4>
              <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
            </div>
          </div>
          
          <div class="item">
            <div class="icon">
              <img src="assets/images/service-icon-02.png" alt="">
            </div>
            <div class="down-content">
              <h4>Online Meeting</h4>
              <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
            </div>
          </div>
          
          <div class="item">
            <div class="icon">
              <img src="assets/images/service-icon-03.png" alt="">
            </div>
            <div class="down-content">
              <h4>Best Networking</h4>
              <p>Suspendisse tempor mauris a sem elementum bibendum. Praesent facilisis massa non vestibulum.</p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

<section class="upcoming-meetings" id="meetings">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Upcoming Meetings</h2>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="categories">
          <h4>Meeting Catgories</h4>
          <ul>
            <li><a href="#">Sed tempus enim leo</a></li>
            <li><a href="#">Aenean molestie quis</a></li>
            <li><a href="#">Cras et metus vestibulum</a></li>
            <li><a href="#">Nam et condimentum</a></li>
            <li><a href="#">Phasellus nec sapien</a></li>
          </ul>
          <div class="main-button-red">
            <a href="meetings.html">All Upcoming Meetings</a>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">
                <div class="price">
                  <span>$22.00</span>
                </div>
                <a href="meeting-details.html"><img src="assets/images/meeting-01.jpg" alt="New Lecturer Meeting"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>10</span></h6>
                </div>
                <a href="meeting-details.html"><h4>New Lecturers Meeting</h4></a>
                <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">
                <div class="price">
                  <span>$36.00</span>
                </div>
                <a href="meeting-details.html"><img src="assets/images/meeting-02.jpg" alt="Online Teaching"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>24</span></h6>
                </div>
                <a href="meeting-details.html"><h4>Online Teaching Techniques</h4></a>
                <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">
                <div class="price">
                  <span>$14.00</span>
                </div>
                <a href="meeting-details.html"><img src="assets/images/meeting-03.jpg" alt="Higher Education"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>26</span></h6>
                </div>
                <a href="meeting-details.html"><h4>Higher Education Conference</h4></a>
                <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="meeting-item">
              <div class="thumb">
                <div class="price">
                  <span>$48.00</span>
                </div>
                <a href="meeting-details.html"><img src="assets/images/meeting-04.jpg" alt="Student Training"></a>
              </div>
              <div class="down-content">
                <div class="date">
                  <h6>Nov <span>30</span></h6>
                </div>
                <a href="meeting-details.html"><h4>Student Training Meetup</h4></a>
                <p>Morbi in libero blandit lectus<br>cursus ullamcorper.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="apply-now" id="apply">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="row">
          <div class="col-lg-12">
            <div class="item">
              <h3>APPLY FOR BACHELOR DEGREE</h3>
              <p>You are allowed to use this edu meeting CSS template for your school or university or business. You can feel free to modify or edit this layout.</p>
              <div class="main-button-red">
                <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
            </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="item">
              <h3>APPLY FOR BACHELOR DEGREE</h3>
              <p>You are not allowed to redistribute the template ZIP file on any other template website. Please contact us for more information.</p>
              <div class="main-button-yellow">
                <div class="scroll-to-section"><a href="#contact">Join Us Now!</a></div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="accordions is-first-expanded">
          <article class="accordion">
              <div class="accordion-head">
                  <span>About Edu Meeting HTML Template</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>If you want to get the latest collection of HTML CSS templates for your websites, you may visit <a rel="nofollow" href="https://www.toocss.com/" target="_blank">Too CSS website</a>. If you need a working contact form script, please visit <a href="https://templatemo.com/contact" target="_parent">our contact page</a> for more info.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
              <div class="accordion-head">
                  <span>HTML CSS Bootstrap Layout</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Etiam posuere metus orci, vel consectetur elit imperdiet eu. Cras ipsum magna, maximus at semper sit amet, eleifend eget neque. Nunc facilisis quam purus, sed vulputate augue interdum vitae. Aliquam a elit massa.<br><br>
                      Nulla malesuada elit lacus, ac ultricies massa varius sed. Etiam eu metus eget nibh consequat aliquet. Proin fringilla, quam at euismod porttitor, odio odio tempus ligula, ut feugiat ex erat nec mauris. Donec viverra velit eget lectus sollicitudin tincidunt.</p>
                  </div>
              </div>
          </article>
          <article class="accordion">
              <div class="accordion-head">
                  <span>Please tell your friends</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Ut vehicula mauris est, sed sodales justo rhoncus eu. Morbi porttitor quam velit, at ullamcorper justo suscipit sit amet. Quisque at suscipit mi, non efficitur velit.<br><br>
                      Cras et tortor semper, placerat eros sit amet, porta est. Mauris porttitor sapien et quam volutpat luctus. Nullam sodales ipsum ac neque ultricies varius.</p>
                  </div>
              </div>
          </article>
          <article class="accordion last-accordion">
              <div class="accordion-head">
                  <span>Share this to your colleagues</span>
                  <span class="icon">
                      <i class="icon fa fa-chevron-right"></i>
                  </span>
              </div>
              <div class="accordion-body">
                  <div class="content">
                      <p>Maecenas suscipit enim libero, vel lobortis justo condimentum id. Interdum et malesuada fames ac ante ipsum primis in faucibus.<br><br>
                      Sed eleifend metus sit amet magna tristique, posuere laoreet arcu semper. Nulla pellentesque ut tortor sit amet maximus. In eu libero ullamcorper, semper nisi quis, convallis nisi.</p>
                  </div>
              </div>
          </article>
      </div>
      </div>
    </div>
  </div>
</section>

<section class="our-courses" id="courses">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>Our Popular Courses</h2>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="owl-courses-item owl-carousel">
          <div class="item">
            <img src="assets/images/course-01.jpg" alt="Course One">
            <div class="down-content">
              <h4>Morbi tincidunt elit vitae justo rhoncus</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$160</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-02.jpg" alt="Course Two">
            <div class="down-content">
              <h4>Curabitur molestie dignissim purus vel</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$180</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-03.jpg" alt="">
            <div class="down-content">
              <h4>Nulla at ipsum a mauris egestas tempor</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$140</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-04.jpg" alt="">
            <div class="down-content">
              <h4>Aenean molestie quis libero gravida</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$120</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-01.jpg" alt="">
            <div class="down-content">
              <h4>Lorem ipsum dolor sit amet adipiscing elit</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$250</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-02.jpg" alt="">
            <div class="down-content">
              <h4>TemplateMo is the best website for Free CSS</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$270</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-03.jpg" alt="">
            <div class="down-content">
              <h4>Web Design Templates at your finger tips</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$340</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-04.jpg" alt="">
            <div class="down-content">
              <h4>Please visit our website again</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$360</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-01.jpg" alt="">
            <div class="down-content">
              <h4>Responsive HTML Templates for you</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$400</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-02.jpg" alt="">
            <div class="down-content">
              <h4>Download Free CSS Layouts for your business</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$430</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-03.jpg" alt="">
            <div class="down-content">
              <h4>Morbi in libero blandit lectus cursus</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$480</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="assets/images/course-04.jpg" alt="">
            <div class="down-content">
              <h4>Curabitur molestie dignissim purus</h4>
              <div class="info">
                <div class="row">
                  <div class="col-8">
                    <ul>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </div>
                  <div class="col-4">
                     <span>$560</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="our-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <h2>A Few Facts About Our University</h2>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content percentage">
                  <div class="count-digit">94</div>
                  <div class="count-title">Succesed Students</div>
                </div>
              </div>
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit">126</div>
                  <div class="count-title">Current Teachers</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content new-students">
                  <div class="count-digit">2345</div>
                  <div class="count-title">New Students</div>
                </div>
              </div> 
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit">32</div>
                  <div class="count-title">Awards</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="col-lg-6 align-self-center">
        <div class="video">
          <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection