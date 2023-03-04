<link rel="stylesheet" href="https://use.typekit.net/ozy7lkl.css">
<style scoped>
  .menu_container {
    width: 100%;
    height: 100px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: left;
    background-color: #eee;
    z-index: 10;
  }

  .menu {
    display: flex;
    align-items: center;
    width: 250px;
    border-radius: 5px;

  }

  .menu_title {
    font-family: "nimbus-sans", sans-serif;
    color: #305dff;
    font-size: 36px;
  }

  @media screen and (max-width:768px) {
    .menu_title {
      display: none;
    }
  }

  .humburger-menu {
    width: 30px;
    height: 30px;
    position: relative;
    cursor: pointer;
    background-color: #305dff;
    box-shadow: 1px 1px 5px 0 rgba(0, 0, 0, .3);
    border-radius: 5px;
    padding: 10px;
    margin: 0 10px 0 50px;
    z-index: 1000;
  }

  .menu__line {
    display: inline-block;
    height: 1px;
    background-color: #fff;
    position: absolute;
    transition: 0.5s;
    border: 1px solid #fff;
    opacity: .5;
    color: #eee;
  }


  .menu__line--top {
    top: 12;
    width: 30%;
  }

  .menu__line--middle {
    top: 20px;
    width: 50%;
  }

  .menu__line--bottom {
    top: 28px;
    width: 10%;
  }

  .humburger-menu.open span:nth-of-type(1) {
    top: 20px;
    transform: rotate(45deg);
    width: 50%;
  }

  .humburger-menu.open span:nth-of-type(2) {
    opacity: 0;
  }

  .humburger-menu.open span:nth-of-type(3) {
    top: 20px;
    transform: rotate(-45deg);
    width: 50%;
  }

  .drawer-nav {
    display: none;

  }

  .drawer-nav {
    display: block;
    position: absolute;
    height: 100vh;
    width: 100%;
    top: 0;
    left: -100%;
    transition: 0.7s;
    text-align: center;
    background-color: #eee;
    z-index: 50;
  }

  .drawer-nav__list {
    display: block;
    padding-top: 80px;
    list-style: none;
  }

  .drawer-nav__item {
    list-style-type: none;
    margin: 10px auto;
  }

  .drawer-nav__item a {
    display: inline-block;
    width: 80%;
    font-size: 30px;
  }

  .nav_link {
    color: #305dff;
    text-decoration: none;

  }

  .in {
    transform: translateX(100%);
  }
</style>
<div class="menu_container">
  <div class="menu">
    <div class="humburger-menu" id="humburger-menu">
      <span class="menu__line menu__line--top"></span>
      <span class="menu__line menu__line--middle"></span>
      <span class="menu__line menu__line--bottom"></span>
    </div>
    <p class="menu_title">Rese</p>
  </div>
  <div class="drawer-nav" id="drawer-nav">
    <ul class="drawer-nav__list">
      <li class="drawer-nav__item">
        <a href="/" class="nav_link">Home</a>
      </li>
      <li class="drawer-nav__item">
        @guest
        <a href="/register" class="nav_link">Registration</a>
        @endguest
        @auth
        <a href="/mypage" class="nav_link">Mypage</a>
        @endauth
      </li>
      <li class="drawer-nav__item">
        @guest
        <a href="/login" class="nav_link">Login</a>
        @endguest
        @auth
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')" class="nav_link" onclick="event.preventDefault();
          this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>

        @endauth
      </li>
    </ul>
  </div>
</div>

<script>
  const humburger_target = document.getElementById("humburger-menu");
  humburger_target.addEventListener("click", () => {
    humburger_target.classList.toggle("open");
    const nav = document.getElementById("drawer-nav");
    nav.classList.toggle('in');
  });
</script>