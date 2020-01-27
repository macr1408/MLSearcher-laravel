<template>
  <div class="bg-yellow-primary">
    <nav class="flex items-center justify-between flex-wrap container">
      <div class="flex items-center flex-shrink-0 text-gray-800 mr-6">
        <a :href="links.home">
          <svg
            class="fill-current h-8 w-8 mr-2"
            width="54"
            height="54"
            viewBox="0 0 54 54"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"
            />
          </svg>
        </a>
        <a :href="links.home">
          <span class="font-semibold text-xl tracking-tight lg:hidden">Mercadolibre DF</span>
          <span
            class="font-semibold text-xl tracking-tight hidden lg:block"
          >Mercadolibre Deals Finder</span>
        </a>
      </div>
      <div class="lg:hidden navbar-burger">
        <button
          class="flex items-center px-3 py-2 border rounded text-gray-800 border-gray-800 hover:text-black hover:border-black focus:outline-none"
          @click="burgerOpen = !burgerOpen"
        >
          <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
          </svg>
        </button>
      </div>
      <div
        class="w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto"
        :class="burgerOpen ? 'block' : 'hidden'"
      >
        <div class="text-sm lg:flex-grow justify-between">
          <div class="block lg:inline-block py-6" style="width: 65%;">
            <a :href="links.home" class="mt-4 lg:mt-0 text-gray-800 hover:text-black mr-4">Home</a>
          </div>
          <div
            class="block lg:inline-block cursor-pointer hover:text-black relative py-6"
            style="width: 30%;"
            @mouseover="accountMenuHover = true"
            @mouseleave="accountMenuHover = false"
          >
            <a
              class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-black"
            >{{ user.mail }} ▼</a>
            <div class="shadow bg-white absolute" style="top: 50px;" v-show="accountMenuHover">
              <transition name="fade">
                <ul>
                  <a href="/user/favorites">
                    <li class="py-4 pl-4 pr-8 hover:bg-yellow-400">Favoritos</li>
                  </a>
                  <a href="/user/settings">
                    <li class="py-4 pl-4 pr-8 hover:bg-yellow-400">Configuración</li>
                  </a>
                  <a href="/logout">
                    <li class="py-4 pl-4 pr-8 hover:bg-yellow-400">Salir</li>
                  </a>
                </ul>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      accountMenuHover: false,
      links: {
        home: window.navBarLinks.home
      },
      user: {
        mail: window.userData.mail
      },
      burgerOpen: false
    };
  },
  props: ["loggedIn"]
};
</script>
