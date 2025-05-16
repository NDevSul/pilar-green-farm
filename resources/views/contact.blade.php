<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - Pilar Green Farm</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .contact-icon-container {
      @apply bg-green-100 dark:bg-green-900/30 p-3 rounded-full flex items-center justify-center;
      width: 48px;
      height: 48px;
    }

    .contact-card {
      @apply bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 p-6 sm:p-8 transition-transform duration-300 ease-in-out;
    }

    .contact-card:hover {
      @apply shadow-lg;
      transform: translateY(-4px);
    }

    .map-container {
      @apply rounded-xl overflow-hidden h-96 shadow-md border border-gray-200 dark:border-gray-700;
      filter: grayscale(1);
      transition: filter 0.5s ease;
    }

    .map-container:hover {
      filter: grayscale(0);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in {
      animation: fadeIn 0.6s ease-out forwards;
    }
  </style>
</head>
<body class="bg-green-50 text-green-900 dark:bg-gray-900 dark:text-green-100 transition-colors duration-300">
  <!-- Navbar tetap -->
  <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i class="fas fa-leaf text-green-600 dark:text-green-400 text-2xl"></i>
        <span class="text-2xl font-bold text-green-800 dark:text-green-200 font-serif">Pilar Green Farm</span>
      </div>
      @include('layouts.navigation')
    </div>
  </header>

  <!-- Main Section -->
  <main class="max-w-5xl mx-auto py-16 px-4 sm:px-6 lg:px-8 space-y-12">

    <!-- Informasi Kontak -->
    <div class="contact-card animate-fade-in text-center">
      <h1 class="text-4xl font-extrabold text-green-700 dark:text-green-400 mb-4">Hubungi Kami</h1>
      <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
        Kami siap membantu Anda! Silakan hubungi kami melalui informasi di bawah ini.
      </p>

      <div class="grid sm:grid-cols-1 gap-6 max-w-md mx-auto text-left">
        <div class="flex items-start">
          <div class="contact-icon-container mr-4">
            <i class="fas fa-map-marker-alt text-green-600 dark:text-green-400 text-lg"></i>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Alamat</h3>
            <p class="text-gray-700 dark:text-gray-300 mt-1">Pilar Bali Furniture, Jl. Raya Sakah No.5X, Batuan Kaler, Sukawati, Gianyar Regency, Bali 80582</p>
          </div>
        </div>

        <div class="flex items-start">
          <div class="contact-icon-container mr-4">
            <i class="fas fa-envelope text-green-600 dark:text-green-400 text-lg"></i>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Email</h3>
            <p class="text-gray-700 dark:text-gray-300 mt-1">greenurbanfarm@gmail.com</p>
          </div>
        </div>

        <div class="flex items-start">
          <div class="contact-icon-container mr-4">
            <i class="fas fa-phone text-green-600 dark:text-green-400 text-lg"></i>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900 dark:text-gray-100">Telepon</h3>
            <p class="text-gray-700 dark:text-gray-300 mt-1">+62 812-3456-7890</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Jam Operasional -->
    <div class="contact-card animate-fade-in">
      <h2 class="text-2xl font-bold text-green-700 dark:text-green-400 mb-4">Jam Operasional</h2>
      <div class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
        <div class="flex justify-between py-2">
          <span>Senin - Jumat</span>
          <span>08:00 - 17:00</span>
        </div>
        <div class="flex justify-between py-2">
          <span>Sabtu</span>
          <span>09:00 - 12:00</span>
        </div>
        <div class="flex justify-between py-2">
          <span>Minggu</span>
          <span>Tutup</span>
        </div>
      </div>
    </div>

    <!-- Peta Lokasi -->
    <div class="contact-card animate-fade-in">
      <h2 class="text-2xl font-bold text-green-700 dark:text-green-400 mb-4">Peta Lokasi</h2>
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.2035417165853!2d115.2740059744769!3d-8.576418587025637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23e1b402a9945%3A0x4c7e01b07e666793!2sPilar%20Bali%20Furniture!5e0!3m2!1sen!2sid!4v1746543610219!5m2!1sen!2sid"
          width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi Pilar Green Farm"
        ></iframe>
      </div>
    </div>

  </main>
</body>
</html>
