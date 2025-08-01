<!DOCTYPE html>
<html lang="en">
<head>

    @if(session('login_success'))
        <meta http-equiv="refresh" content="0; url=/" />
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shepherd Animal Clinic - Professional veterinary care for your pets">
    <meta name="keywords" content="veterinary, pet care, animal clinic, dog grooming, pet vaccination">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Shepherd Animal Clinic - Veterinary Services</title>
</head>
<body class="{{ Auth::check() ? 'authenticated' : 'guest' }}">
<header>
    <div class="logo-container">
        <div>
            <h1 class="logo">SHEPHERD ANIMAL CLINIC</h1>
            <div class="tagline">Taking care of your furry friends</div>
        </div>
    </div>

    <div class="auth-buttons">
            @auth
            <div class="greeting">Welcome, {{ Auth::user()->name }}!</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="auth-button">LOGOUT</button>
            </form>

            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">🔧 Admin Dashboard</a>
            @endif

        @endauth

        @guest
            <button class="auth-button" id="loginBtn" aria-expanded="false" aria-controls="loginDropdown">LOGIN</button>
            <button class="auth-button" id="signupBtn" aria-expanded="false" aria-controls="signupDropdown">SIGN UP</button>
        @endguest
    </div>

        {{-- Login Dropdown --}}
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="auth-dropdown" id="loginDropdown" role="dialog" aria-modal="true" aria-hidden="true">
            <button class="close-btn" id="closeLogin" aria-label="Close login form">×</button>
            <form class="auth-form" method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="form-title">Member Login</h3>
                <div class="input-group">
                    <label for="login_email">Email</label>
                    <input type="email" id="login_email" name="email" autocomplete="email" required>
                </div>
                <div class="input-group">
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="password" autocomplete="current-password" required>
                </div>
                <button type="submit" class="submit-button">LOGIN</button>
                <p>Don't have an account? <a href="#" id="switchToSignup">Sign up</a></p>
            </form>
        </div>

        {{-- Signup Dropdown --}}
                <div class="auth-dropdown" id="signupDropdown" role="dialog" aria-modal="true" aria-hidden="true">
                    <button class="close-btn" id="closeSignup" aria-label="Close signup form">×</button>
                    <form class="auth-form" method="POST" action="{{ route('signup') }}">
                        @csrf
                        <h3 class="form-title">Create Account</h3>

                        <div class="input-group">
                            <label for="signup_name">Full Name</label>
                            <input type="text" id="signup_name" name="name" required>
                        </div>

                        <div class="input-group">
                            <label for="signup_contact">Cellphone Number</label>
                            <input type="text" id="signup_contact" name="contact" placeholder="Phone Number (+63...)" required pattern="^(\+63|0)?\d{10}$" title="Enter a valid Philippine mobile number">
                        </div>

                        <div class="input-group">
                            <label for="signup_email">Email</label>
                            <input type="email" id="signup_email" name="email" autocomplete="email" required>
                        </div>

                        <div class="input-group">
                            <label for="signup_password">Password</label>
                            <input type="password" id="signup_password" name="password" autocomplete="new-password" required>                        
                        </div>

                        <div class="input-group">
                            <label for="signup_password_confirmation">Confirm Password</label>
                            <input type="password" id="signup_password_confirmation" name="password_confirmation" autocomplete="new-password" required>
                        </div>

                        <button type="submit" class="submit-button">SIGN UP</button>
                        <p>Already have an account? <a href="#" id="switchToLogin">Login</a></p>
                    </form>
                </div> 
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#dogcaretips">Dog Care Tips</a></li>
            <li><a href="#contact">Contact Us</a></li>
            @auth
                <li>
                    @if(auth()->user()->is_admin)
                        <a href="javascript:void(0);" class="hover:text-[#4d6b3c] cursor-default">Pet Records</a>
                    @else
                        <a href="{{ route('pets.index') }}" class="hover:text-[#4d6b3c]">Pet Records</a>
                    @endif
                </li>
                <li>
                    @if(auth()->user()->is_admin)
                        <a href="javascript:void(0);" class="hover:text-[#4d6b3c] cursor-default">Products</a>
                    @else
                        <a href="{{ route('product.index') }}" class="hover:text-[#4d6b3c]">Products</a>
                    @endif
                </li>
            @endauth
        </ul>
    </nav>

    <main class="container">
        <section id="home" aria-labelledby="home-heading">
            <h2 id="home-heading">Welcome to Shepherd Animal Clinic</h2>
            <p>We are dedicated to providing exceptional veterinary care with a gentle touch. Whether your pet needs a routine checkup, vaccinations, surgery, or emergency treatment, our experienced and compassionate team is here to keep them healthy and happy. We treat every animal like our own, offering personalized care in a warm, welcoming environment. Trust Shepherd Animal Clinic for expert veterinary services—because your pet's well-being is our top priority!</p>
        </section>
        <br>
        <section class="home" id="home">
        <div class="slider-container">
            <div class="slider">
                <div class="slide">
                    <img src="{{ asset('images/HappyDog.jpg') }}" alt="Happy dog">
                    <div class="slide-content">
                        <h3>Happy Pets</h3>
                        <p>We care for your pet's happiness</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/VeterinaryCare.jpg') }}" alt="Veterinary care">
                    <div class="slide-content">
                        <h3>Expert Care</h3>
                        <p>Professional veterinary services</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/DogGromming.jpg') }}" alt="Dog grooming">
                    <div class="slide-content">
                        <h3>Grooming Services</h3>
                        <p>Keep your pet looking their best</p>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('images/PetHealthCheck.jpg') }}" alt="Pet health check">
                    <div class="slide-content">
                        <h3>Annual Checkups</h3>
                        <p>Preventive care saves lives</p>
                    </div>
                </div>
            </div>
            <button class="slider-arrow prev">❮</button>
            <button class="slider-arrow next">❯</button>
            <div class="slider-nav">
                <div class="slider-dot active"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
            </div>
        </div>
            
        <section id="services" aria-labelledby="services-heading">
            <h2 id="services-heading">Our Services</h2>
            <p>At our veterinary clinic...</p>
            <br>
            <div class="services">
                <article class="service-card">
                    <img src="{{ asset('images/Grooming.jpg') }}" alt="Dog being groomed by a professional">
                    <h3>Grooming</h3>
                    <p>Bath, brush, and nail trimming for your dog.</p>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn book-btn" aria-label="Book grooming service">Book Now</a>
                    @endauth
                    </article>
                <article class="service-card">
                    <img src="{{ asset('images/Consultation.jpg') }}" alt="Veterinarian examining a dog">
                    <h3>Consultation</h3>
                    <p>Consult your dog now</p>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn book-btn" aria-label="Book grooming service">Book Now</a>
                    @endauth
                    </article>
                <article class="service-card">
                    <img src="{{ asset('images/Surgery.jpg') }}" alt="Veterinary surgery room">
                    <h3>Surgery</h3>
                    <p>Advanced surgical care for your pet.</p>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn book-btn" aria-label="Book grooming service">Book Now</a>
                    @endauth
                    </article>
                <article class="service-card">
                    <img src="{{ asset('images/Laboratory.jpg') }}" alt="Veterinary laboratory equipment">
                    <h3>Laboratory</h3>
                    <p>Accurate and fast diagnostics.</p>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn book-btn" aria-label="Book grooming service">Book Now</a>
                    @endauth
                    </article>
                <article class="service-card">
                    <img src="{{ asset('images/Vaccination.jpg') }}" alt="Dog receiving vaccination">
                    <h3>Vaccination</h3>
                    <p>Protect your pet from diseases.</p>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn book-btn" aria-label="Book grooming service">Book Now</a>
                    @endauth
                    </article>
            </div>
        </section>

        <section id="dogcaretips" aria-labelledby="tips-heading">
            <h2 id="tips-heading">Dog Care Tips</h2>
            <p>Taking care of your dog involves a mix of proper nutrition, regular health check-ups, grooming, exercise, and lots of love...</p>
        </section>
        <br>
        <div class="dog-gallery">
            <div class="dog-card">
                <img src="{{ asset('images/Chihuahua.jpg') }}" alt="Chihuahua" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">Chihuahua</h2>
                    <a href="#" class="view-btn view-chihuahua" data-description="Chihuahuas may be small, but they need big care! Keep them warm in cool weather, protect their fragile bones, and brush their teeth regularly to prevent dental issues. Provide short daily walks and mental stimulation to keep them active without overexertion. Feed high-quality small-breed food in proper portions to maintain a healthy weight. Early socialization helps curb their feisty temperament. Regular vet check-ups are essential to monitor for common health problems like hypoglycemia and heart conditions. With proper care, your tiny companion will thrive!">View >>></a>
                    </div>
            </div>
            <div class="dog-card">
                <img src="{{ asset('images/Pomeranian.jpg') }}" alt="Pomeranian" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">Pomeranian</h2>
                    <a href="#" class="view-btn view-pomeranian" data-description="Poms need daily brushing for their fluffy coat and monthly grooming. Protect their tiny joints - no high jumps! Walk them daily but avoid overexertion. Brush teeth 3-4x weekly to prevent dental disease. Use a harness (not collar) to protect their delicate trachea. Feed small-breed formula to maintain energy. Socialize early to curb excessive barking. Watch for luxating patellas and schedule regular vet checks. Their big personality needs patient training and lots of love!">View >>></a>
                </div>
            </div>
            <div class="dog-card">
                <img src="{{ asset('images/GermanShepherd.jpg') }}" alt="German Shepherd" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">German Shepherd</h2>
                    <a href="#" class="view-btn view-GermanShepherd" data-description="Active and intelligent, German Shepherds need daily exercise (1-2 hours) and mental challenges to stay happy. Their double coat requires weekly brushing (daily during shedding season). Avoid overexertion in puppies to protect developing joints and hips - ask your vet about hip dysplasia prevention. Train early with positive reinforcement to channel their protective instincts properly. Feed large-breed formula to support their size and energy. Watch for common issues like bloat (feed smaller meals) and degenerative myelopathy. Regular vet checks and proper socialization are key to raising a well-adjusted companion.">View >>></a>
                </div>
            </div>
            <div class="dog-card">
                <img src="{{ asset('images/Bulldog.jpg') }}" alt="Bulldog" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">Bulldog</h2>
                    <a href="#" class="view-btn view-Bulldog" data-description="Bulldogs are lovable but need special care. Their short snouts make them prone to breathing problems – avoid overheating and strenuous exercise. Clean their face wrinkles daily to prevent infections. Their sensitive skin may need special shampoos. Keep them in air-conditioned spaces during hot weather. Feed weight-management food to avoid obesity, a common issue. Use a harness instead of a collar to protect their neck. Watch for hip dysplasia and eye problems. Regular vet visits are essential for this adorable but high-maintenance breed.">View >>></a>
                    </div>
            </div>
            <div class="dog-card">
                <img src="{{ asset('images/Aspin.jpg') }}" alt="Aspin" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">Aspin</h2>
                    <a href="#" class="view-btn view-Aspin" data-description="ASPINs are tough, smart, and low-maintenance Philippine dogs. Their short coats need just weekly brushing. They thrive on moderate exercise (30-60 mins daily) and mental challenges. Feed quality local-brand food with proper portions to avoid obesity. Vaccinate regularly against common tropical diseases like parvo and distemper. Train with positive reinforcement – they're eager learners! Watch for skin allergies (common in humid climates) and tick-borne illnesses. Most ASPINs are naturally hardy, but annual vet checks keep them in top shape. Their loyalty and adaptability make them perfect Filipino companions!">View >>></a>
                </div>
            </div>
            <div class="dog-card">
                <img src="{{ asset('images/Poodle.jpg') }}" alt="Poodle" class="dog-image">
                <div class="dog-info">
                    <h2 class="dog-name">Poodle</h2>
                    <a href="#" class="view-btn view-Poodle" data-description="Poodles (Toy, Miniature & Standard) need regular grooming every 4-6 weeks to maintain their curly, hypoallergenic coat. Brush daily to prevent mats. Their high intelligence requires mental stimulation (puzzle toys, training) to avoid boredom. Provide daily exercise (walks, playtime) adjusted to their size. Poodles are prone to ear infections, so clean ears weekly. Use dog-safe shampoo to protect their sensitive skin. Feed high-quality food matching their size/age. Watch for joint issues (especially in Toys/Minis) and eye problems. Regular vet visits help maintain their elegant looks and lively personality!">View >>></a>
                </div>
            </div>
        </div>

        <div id="dogModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <img id="modalImage" src="" alt="Dog" style="width:100%; max-height:300px; object-fit:cover; border-radius:8px; margin-bottom:15px;">
                <h2 id="modalTitle"></h2>
                <p id="modalDescription"></p>
            </div>
        </div>

        <section id="contact" aria-labelledby="contact-heading">
            <h2 id="contact-heading">Contact Us</h2>
            <article class="service-card">
                <img src="{{ asset('images/logo.jpg') }}" alt="Veterinarian examining a dog">
                <div class="branch-hours">
                    <div class="branch">
                        <h4>Tungko Branch</h4>
                        <p>You may visit us at Door 1 Florinda Building Pecsonville Quirino Highway Tungko SJDM (infront of SM San Jose Del Monte)</p>
                        <h3>Clinic Hours</h3>
                        <p>Monday-Sunday: 8am - 5pm</p>
                        <p>Phone: <a href="tel:09088628251">09088628251</a></p>
                    </div>
                    <div class="branch">
                        <h4>Muzon Branch</h4>
                        <p>You may visit us at Blk 1 Lot 6 Provincial Road Sitio Libis II, Muzon San Jose Del Monte Bulacan (beside LCC College)</p>
                        <h3>Clinic Hours</h3>
                        <p>Monday-Saturday: 8am - 4pm</p>
                        <p>Phone <a href="tel:09093700840">09093700840</a></p>
                    </div>
                </div>
                <div class="contact-info">
                <p>Email: <a href="mailto:shepherdanimalclinictungko@gmail.com">shepherdanimalclinictungko@gmail.com</a></p>
                    <p>Facebook : /shepherdanimalclinicmain</p>
                </div>
            </article>
        </section>
    </main>

    <button id="scrollToTopBtn" title="Go to top">⬆</button>

    <!-- Book Now Prompt Modal -->
    <div id="bookNowPrompt" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <h3>Please log in or sign up to book an appointment.</h3>
            <div class="modal-actions">
                <button id="promptLogin" class="auth-button">Login</button>
                <button id="promptSignup" class="auth-button">Sign Up</button>
                <button id="closeBookNow" class="auth-button cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    window.isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
    </script>
    <script src="{{ asset('js/Myscript.js') }}"></script>

    <!-- Booking Modal -->
<div id="bookingModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <button class="close-btn" id="closeBookingModal">×</button>
        <h3>Book an Appointment</h3>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <div class="input-group">
                <label for="pet_name">Pet Name</label>
                <input type="text" name="pet_name" id="pet_name" required>
            </div>
            <div class="input-group">
                <label for="service_type">Service</label>
                <select name="service_type" id="service_type" required>
                    <option value="Grooming">Grooming</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Surgery">Surgery</option>
                    <option value="Laboratory">Laboratory</option>
                    <option value="Vaccination">Vaccination</option>
                </select>
            </div>
            <div class="input-group">
                <label for="preferred_date">Preferred Date</label>
                <input type="date" name="preferred_date" id="preferred_date" required>
            </div>
            <div class="input-group">
                <label for="preferred_time">Preferred Time</label>
                <input type="time" name="preferred_time" id="preferred_time" required>
            </div>
            <div class="input-group">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" rows="3"></textarea>
            </div>
            <button type="submit" class="submit-button">Submit Booking</button>
        </form>
    </div>
</div>

@auth
    <li><a href="{{ route('dashboard') }}">My Appointments</a></li>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>