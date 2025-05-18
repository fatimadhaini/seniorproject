<!DOCTYPE html>
<html lang="en">
@include('client.common.head')

<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section accent-background">
      @include('client.common.navbar')

      <!-- Background Video -->
      <video autoplay loop muted playsinline class="hero-video">
        <source src="{{ asset('assets/videos/hero.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
      </video>


      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5 justify-content-between">


        </div>
      </div>
    </section>
    <!-- /Hero Section -->
    <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
      <div class="container position-relative">
        <div class="container mt-5" style="margin: 0 3%; max-width: 1200px;">
          <div class="row gy-1">
            <!-- Card 1 -->
            <div class="col-md-6 col-lg-3">
              <div class="head1" style="background-image:url('./assets/img/head1.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <p class="heading">
                  Academic Excellence
                </p>
                <p></p>
              </div>
            </div><!-- End Card 1 -->

            <!-- Card 2 -->
            <div class="col-md-6 col-lg-3">
              <div class="head1" style="background-image:url('./assets/img/head2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <p class="heading">Blind Students Support</p>
                <p></p>
              </div>
            </div><!-- End Card 2 -->

            <!-- Card 3 -->
            <div class="col-md-6 col-lg-3">
              <div class="head1" style="background-image:url('./assets/img/head3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <p class="heading">Non Verbal Students Support</p>
                <p></p>
              </div>
            </div><!-- End Card 3 -->

            <!-- Card 4 -->
            <div class="col-md-6 col-lg-3">
              <div class="head1" style="background-image:url('./assets/img/head4.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <p class="heading">Paralyzed Students Support</p>
                <p></p>
              </div>
            </div><!-- End Card 4 -->
          </div>
        </div>

        <!-- About Section -->
        <section id="about" class="about section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>About Us<br></h2>
            <p>At Vision Voice , we are dedicated to fostering a vibrant academic community. Established in 2024,
              our institution of excellence in education, research, and community service.</p>
          </div><!-- End Section Title -->

          <div class="container">

            <div class="row gy-4">
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <h3>Our Mission</h3>
                <video autoplay loop muted playsinline class="img-fluid rounded-4 mb-4" alt="">
                  <source src="{{ asset('assets/videos/video2.mp4') }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                <p>VisionVoice, a smart school management system designed to empower blind, nonverbal, and paralyzed students. Our goal is to provide them with an inclusive, AI-powered educational environment that enhances accessibility, communication, and independence.</p>
              </div>
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="content ps-0 ps-lg-5">
                  <p class="fst-italic">
                    Academic Excellence
                  </p>
                  <ul>
                    <li><i class="bi bi-check-circle-fill"></i> <span>At its core, VisionVoice harnesses the power of artificial intelligence, voice recognition, speech synthesis, and gesture-based interaction to break communication barriers and support independent learning.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i> <span>Our mission is to amplify the voices of those often unheard, ensuring every student—regardless of ability—can fully participate, engage, and thrive in their educational journey.</span></li>
                    <li><i class="bi bi-check-circle-fill"></i> <span> From navigating lessons with voice commands to real-time attendance, calendar updates, and personalized class interactions, every feature is crafted with accessibility in mind.</span></li>
                  </ul>
                  <p>
                    Our School is a hub of research and innovation.We encourage collaboration across
                    disciplines and with industry partners to address global challenges and drive progress.
                  </p>

                  <div class="position-relative mt-4">
                    <img src="./assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

          <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

              <div class="col-lg-5">
                <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
              </div>

              <div class="col-lg-7">

                <div class="row gy-4">

                  <div class="col-lg-6">
                    <div class="stats-item d-flex">
                      <i class="bi bi-emoji-smile flex-shrink-0"></i>
                      <div>
                        <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Empowered Students</strong> <span>blind, nonverbal, and paralyzed learners thriving with AI</span></p>
                      </div>
                    </div>
                  </div><!-- End Stats Item -->

                  <div class="col-lg-6">
                    <div class="stats-item d-flex">
                      <i class="bi bi-journal-richtext flex-shrink-0"></i>
                      <div>
                        <span data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Accessible Lessons</strong> <span>AI-enhanced content delivered inclusively</span></p>
                      </div>
                    </div>
                  </div><!-- End Stats Item -->

                  <div class="col-lg-6">
                    <div class="stats-item d-flex">
                      <i class="bi bi-headset flex-shrink-0"></i>
                      <div>
                        <span data-purecounter-start="0" data-purecounter-end="10000" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>AI-Assisted Interactions</strong> <span>spoken commands and responses handled</span></p>
                      </div>
                    </div>
                  </div><!-- End Stats Item -->

                  <div class="col-lg-6">
                    <div class="stats-item d-flex">
                      <i class="bi bi-people flex-shrink-0"></i>
                      <div>
                        <span data-purecounter-start="0" data-purecounter-end="75" data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Team & Volunteers</strong> <span>driven by purpose, innovation, and accessibility</span></p>
                      </div>
                    </div>
                  </div><!-- End Stats Item -->

                </div>


              </div>

            </div>

          </div>

        </section><!-- /Stats Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section dark-background">

          <div class="container">
            <img src="assets/img/cta-bg.jpg" alt="VisionVoice empowering education background">
            <div class="content row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
              <div class="col-xl-10">
                <div class="text-center">
                  <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox play-btn" aria-label="Watch our mission video"></a>
                  <h3>Empower Every Voice</h3>
                  <p>At VisionVoice, we believe every student deserves a voice. Our AI-powered smart school system breaks down barriers for blind, nonverbal, and paralyzed students, offering tools for communication, learning, and independence. Join us in shaping a more inclusive future for education.</p>
                  <a class="cta-btn" href="#contact">Get Involved</a>
                </div>
              </div>
            </div>
          </div>

        </section><!-- /Call To Action Section -->


        <!-- Services Section -->
        <section id="services" class="services section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
            <p>At VisionVoice, we provide intelligent, inclusive, and empowering educational services built for students with unique needs.</p>
          </div><!-- End Section Title -->

          <div class="container">
            <div class="row gy-4">

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-ear"></i>
                  </div>
                  <h3>Voice-Controlled Navigation</h3>
                  <p>Enabling blind and paralyzed students to navigate classes, lessons, and calendars through speech recognition and synthesis.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-sign-language"></i>
                  </div>
                  <h3>Sign Language Recognition</h3>
                  <p>AI-powered sign interpretation that converts gestures into spoken words, helping nonverbal students communicate in real time.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-book"></i>
                  </div>
                  <h3>Braille Lesson Translation</h3>
                  <p>Automatic conversion of lesson content into Braille-ready text files to support blind students' literacy and independence.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-calendar-week"></i>
                  </div>
                  <h3>Smart Attendance System</h3>
                  <p>Calendar-based attendance with voice feedback, allowing students to track their academic engagement with ease.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-person-video2"></i>
                  </div>
                  <h3>Live Student Video Feed</h3>
                  <p>Parental access to student livestreams for enhanced visibility and reassurance, built on secure WebRTC technology.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="service-item position-relative">
                  <div class="icon">
                    <i class="bi bi-chat-dots"></i>
                  </div>
                  <h3>Real-Time Messaging</h3>
                  <p>Instant chat between teachers and parents with auto-delete after 24 hours, ensuring communication and privacy.</p>
                  <a href="service-details.html" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                </div>
              </div>

            </div>
          </div>
        </section>
        <!-- /Services Section -->


        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <h2>What People Say</h2>
            <p>Hear from parents, students, and educators about their experiences with VisionVoice's inclusive and intelligent learning system.</p>
          </div><!-- End Section Title -->

          <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 1,
                      "spaceBetween": 40
                    },
                    "1200": {
                      "slidesPerView": 3,
                      "spaceBetween": 10
                    }
                  }
                }
              </script>

              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="Blind student">
                    <h3>Ali Rahim</h3>
                    <h4>Blind Student Parent</h4>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p><i class="bi bi-quote quote-icon-left"></i>
                      <span>VisionVoice changed my child's life. He can access his calendar, listen to lessons, and attend virtual classes—all with my voice.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="Parent">
                    <h3>Lina Kassem</h3>
                    <h4>Parent</h4>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p><i class="bi bi-quote quote-icon-left"></i>
                      <span>As a father of a nonverbal child, I finally feel seen. VisionVoice empowers my son with tools I never thought possible.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="Teacher">
                    <h3>Rania Khoury</h3>
                    <h4>Special Education Teacher</h4>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p><i class="bi bi-quote quote-icon-left"></i>
                      <span>The platform allows seamless communication between teachers and students. It has transformed the way I teach and interact.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="School admin">
                    <h3>Imad Fayad</h3>
                    <h4>School Administrator</h4>
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p><i class="bi bi-quote quote-icon-left"></i>
                      <span> VisionVoice across all special education programs. It's smart, secure, and most importantly—inclusive.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div>

              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>

        </section><!-- /Testimonials Section -->


     

          <!-- Faq Section -->
          <section id="faq" class="faq section">
            <div class="container">
              <div class="row gy-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                  <div class="content px-xl-5">
                    <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                    <p>
                      Learn more about how VisionVoice transforms education for blind, nonverbal, and paralyzed students using inclusive technologies.
                    </p>
                  </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                  <div class="faq-container">

                    <div class="faq-item faq-active">
                      <h3><span class="num">1.</span> <span>What makes VisionVoice unique for disabled students?</span></h3>
                      <div class="faq-content">
                        <p>
                          VisionVoice uses AI-powered voice recognition, speech synthesis, and Braille translation to create a fully accessible learning environment for students with physical or sensory impairments.
                        </p>
                      </div>
                      <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <div class="faq-item">
                      <h3><span class="num">2.</span> <span>Can VisionVoice be used by students who are both blind and nonverbal?</span></h3>
                      <div class="faq-content">
                        <p>
                          Yes. VisionVoice supports alternative communication through sign language recognition, real-time subtitles, and AI-generated voice prompts, ensuring everyone can participate equally.
                        </p>
                      </div>
                      <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <div class="faq-item">
                      <h3><span class="num">3.</span> <span>How are lessons made accessible to blind students?</span></h3>
                      <div class="faq-content">
                        <p>
                          Lessons can be read aloud using screen reading technology and exported into Braille-ready formats. The interface is also keyboard-navigable and voice-controlled.
                        </p>
                      </div>
                      <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <div class="faq-item">
                      <h3><span class="num">4.</span> <span>Does the system support parent communication?</span></h3>
                      <div class="faq-content">
                        <p>
                          Absolutely. Parents receive automatic updates via WhatsApp, SMS, or email, including attendance reports, grades, and event notifications for their children.
                        </p>
                      </div>
                      <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                    <div class="faq-item">
                      <h3><span class="num">5.</span> <span>Is training provided for schools to use VisionVoice?</span></h3>
                      <div class="faq-content">
                        <p>
                          Yes. We offer onboarding sessions, video tutorials, and dedicated support to ensure your teachers and administrators can use the platform effectively from day one.
                        </p>
                      </div>
                      <i class="faq-toggle bi bi-chevron-right"></i>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </section><!-- /Faq Section -->

          <!-- Contact Section -->
          <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <h2>Contact</h2>
              <p>If you have any questions or need support, our team is here to assist you. Reach out to us anytime.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

              <div class="row gx-lg-0 gy-4">

                <div class="col-lg-4">
                  <div class="info-container d-flex flex-column align-items-center justify-content-center">

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                      <i class="bi bi-geo-alt flex-shrink-0"></i>
                      <div>
                        <h3>Address</h3>
                        <p>Beirut, Lebanon<br>Block C, 2nd Floor</p>
                      </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                      <i class="bi bi-telephone flex-shrink-0"></i>
                      <div>
                        <h3>Call Us</h3>
                        <p>+961 70 074639</p>
                      </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                      <i class="bi bi-envelope flex-shrink-0"></i>
                      <div>
                        <h3>Email Us</h3>
                        <p>visionvoice@gmail.com</p>
                      </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                      <i class="bi bi-clock flex-shrink-0"></i>
                      <div>
                        <h3>Working Hours</h3>
                        <p>Mon - Sat: 8:00 AM – 6:00 PM</p>
                      </div>
                    </div><!-- End Info Item -->

                  </div>
                </div>


                <div class="col-lg-8">
                  <form id="contactForm" method="post" class="php-email-form">
                    @csrf
                    <div class="row gy-4">
                      <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                      </div>

                      <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                      </div>

                      <div class="col-md-12">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                      </div>

                      <div class="col-md-12">
                        <textarea name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
                      </div>

                      <div class="col-md-12 text-center">
                        <button type="submit">Send Message</button>
                      </div>
                    </div>
                  </form>

                </div><!-- End Contact Form -->

              </div>
            </div>
          </section><!-- /Contact Section -->


  </main>
  @include('client.common.footer')
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  @include('client.common.scripts')

</body>

</html>
<style>
  .hero {
    position: relative;
    overflow: hidden;
    height: 100vh;
    /* Make it full height */
  }

  .hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* This makes sure the video covers the entire section */
    z-index: -1;
    /* Puts video behind the content */
    opacity: 0.8;
    /* Optional: Add transparency */
  }
</style>
<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch("{{ url('/contact/send') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(res => res.json())
     .then(data => {
  console.log("Debug response:", data); // ✅ console debug
  if (data.status === 'success') {
    Swal.fire({
      icon: 'success',
      title: 'Message Sent!',
      text: data.message,
      confirmButtonColor: '#3674B5'
    });
    form.reset();
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: data.message || 'Something went wrong.',
      confirmButtonColor: '#d33'
    });
  }
})
.catch(err => {
  console.error("AJAX failed:", err); // ✅ show detailed JS error
  Swal.fire({
    icon: 'error',
    title: 'Failed!',
    text: 'An unexpected error occurred.',
    confirmButtonColor: '#d33'
  });
});

  });
</script>