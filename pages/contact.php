<div class="container mb-5">
    <h1 class="my-4 text-center text-uppercase fw-bold text-main-pink">Contact Us</h1>

    <div class="row justify-content-center align-items-stretch">
        <div class="col-md-4">
            <div class="bg-white rounded h-100 px-5 py-5">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your message here..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-5 mt-2">Send Message</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="h-100">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/components/contact_map.php'; ?>
            </div>
        </div>

        <div class="col-md-3">
            <h3 class="text-center fw-bold text-main-pink">Contacts</h3>
            <ul class="list-unstyled text-start bg-white rounded px-3 py-3">
                <li>
                    <button class="btn btn-primary rounded-circle m-1" type="submit" aria-label="Search">
                        <i class="bi bi-telephone-fill" style="font-size: medium;"></i>
                    </button>
                    0912345678
                </li>
                <li>
                    <button class="btn btn-primary rounded-circle m-1" type="submit" aria-label="Search">
                        <i class="bi bi-envelope-fill" style="font-size: medium;"></i>
                    </button>
                    ltb@abc.com
                </li>
                <li>
                    <button class="btn btn-primary rounded-circle m-1" type="submit" aria-label="Search">
                        <i class="bi bi-facebook" style="font-size: medium;"></i>
                    </button>
                    facebook.com/ltb
                </li>
                <li>
                    <button class="btn btn-primary rounded-circle m-1" type="submit" aria-label="Search">
                        <i class="bi bi-instagram" style="font-size: medium;"></i>
                    </button>
                    instagram.com/ltb
                </li>
            </ul>

            <div class="bg-white rounded px-4 py-4">
                <div class="mb-3">
                    <h4 class="text-main-pink">Location</h4>
                    <div>
                        <i class="bi bi-geo-alt-fill text-orange" style="font-size: larger"></i>
                        268 Ly Thuong Kiet, Ward 14, Distric 10, HCM City
                    </div>

                    <div>
                        <i class="bi bi-geo-alt-fill text-orange" style="font-size: larger"></i>
                        30 Tan Thang, Son Ky Ward, Tan Phu District, HCM City
                    </div>

                    <div>
                        <i class="bi bi-geo-alt-fill text-orange" style="font-size: larger"></i>
                        302 Dien Bien Phu, Ward 17, Binh Thanh District, HCM City
                    </div>
                </div>

                <div class="mb-3">
                    <h4 class="text-main-pink">Business Hours</h4>

                    <div>
                        <i class="bi bi-clock-fill text-orange" style="font-size: larger"></i>
                        Mon - Fri: 9:00 - 17:00
                    </div>

                    <div>
                        <i class="bi bi-hourglass-bottom text-orange" style="font-size: larger"></i>
                        Sat - Sun: Closed
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>