<header id="app-toolbar" class="v-sheet v-sheet--tile theme--dark v-toolbar v-app-bar v-app-bar--clipped v-app-bar--fixed v-app-bar--is-scrolled" style="height: 64px; margin-top: 0px; transform: translateY(0px); left: 0px; right: 0px; background-color: #765d55;" data-booted="true">
    <div class="v-toolbar__content" style="height: 64px;">
        <button type="button" aria-label="Menu" class="v-app-bar__nav-icon hidden-lg-and-up v-btn v-btn--flat v-btn--icon v-btn--round theme--dark v-size--default" @click="drawer = !drawer">
            <span class="v-btn__content">
                <i aria-hidden="true" class="v-icon mdi mdi-menu theme--dark"></i>
            </span>
        </button>
        <a href="/" aria-label="Vuetify Home Page" title="Vuetify Home Page" class="router-link-active">
            <div role="img" aria-label="Snippets Logo" class="v-responsive v-image" style="height:38px;width:38px;">
                <div class="v-responsive__sizer" style="padding-bottom: 114.504%;"></div>
                <div class="v-image__image v-image__image--contain" style="background-image: url('{{ asset('img/logo.png') }}'); background-position: center center;"></div>
                <div class="v-responsive__content" style="width: 131px;"></div>
            </div>
        </a>
        <div class="v-toolbar__title hidden-xs-only">
            <a href="/" class="v-btn v-btn--flat v-btn--text theme--dark text-lowercase font-weight-light">
                nippets
            </a>
        </div>
        <div class="spacer"></div>

        <div class="v-toolbar__items">
            @guest
            <a href="{{ route('login') }}" aria-label="{{ __('Login') }}" rel="noopener" class="v-btn v-btn--flat v-btn--text theme--dark v-size--default" style="min-width:48px;">
                <span class="v-btn__content"><span class="hidden-sm-and-down">
                        {{ __('Login') }}
                    </span>
                    <i aria-hidden="true" class="v-icon hidden-sm-and-down v-icon--right material-icons theme--dark">person_pin</i>
                    <i aria-hidden="true" class="v-icon hidden-md-and-up material-icons theme--dark">person_pin</i>
                </span>
            </a>
             @if (Route::has('register'))
                <a href="{{ route('register') }}" aria-label="{{ __('Register') }}" rel="noopener" class="v-btn v-btn--flat v-btn--text theme--dark v-size--default" style="min-width:48px;">
                    <span class="v-btn__content"><span class="hidden-sm-and-down">
                            {{ __('Register') }}
                        </span>
                        <i aria-hidden="true" class="v-icon hidden-sm-and-down v-icon--right material-icons theme--dark">person_add</i>
                        <i aria-hidden="true" class="v-icon hidden-md-and-up material-icons theme--dark">person_add</i>
                    </span>
                </a>
             @endif

             @else
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            text
                            v-on="on"
                            color="#fdf3f6"
                        >
                            {{ auth()->user()->name }}
                            <v-icon>arrow_drop_down</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item @click.prevent="logout">
                            <v-list-item-title class="logout"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >{{ __('Logout') }}
                            </v-list-item-title>
                            <form ref="form" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </v-list-item>

                        <v-list-item href="/user-setting">
                            <v-list-item-title>{{ __('Settings') }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            @endguest
        </div>
    </div>
</header>
