<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/images/user.png" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @yield('admin-style')
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
        @auth
        <button type="button" class="btn btn-lg mid-blue text-light rounded about-btn" data-toggle="modal" data-target="#about">
            About
        </button>
        <!-- Modal -->
        <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 id="exampleModalLabel">Brief History of the Barangay</h1>
                    </div>
                    <div class="modal-body">
                        <p>Long time ago there was an old couple living in small village at the foot of the
                            mountain. The couple was hard-working, kind hearted and welcoming to all the
                            people who visited them in their small nipa hut. But, with all their goodness, they
                            were not blessed with a child. Their backyard was full of vegetables, colorful
                            ornamentals and array of fruit bearing trees. Many villagers often goes to their
                            garden and pick a basket of okra , bataw, sitaw, ampalaya and many more. Young
                            gentlemen also goes to their garden to asked some flowers for their lovely ladies. <br> <br>
                            One day morning, a strange man who seems to have travelled from afar
                            arrived to their nipa hut struggling for a cup of water. The couple right away offered
                            him a water to drink. After pleasing his thirst, the old man noticed the eyes of the
                            stranger. They were naughty as if the strange man was looking for something in their
                            yard. So, the old man asked the strange man, “Amang, Are you alright? Maybe you
                            are tired for you came from a far away village, but I noticed in your eyes that there is
                            something bothering you, what is it? I hope I can help you” said the kind hearted old
                            man. The strange man replied,” Thank you for your generosity but I am not starving;
                            but I need something from you. Please give me some of the amazing ripe fruit in
                            your backyard”. <br> <br>
                            Mystified, the couple accompanied the strange man in their backyard to see
                            what he is talking about. Upon seeing, the strange man went close to the fruit tree
                            and said, “This is what I am looking for; please give me some of these fruit. The old
                            man said “ah this fruit? But sorry, we don’t know the name of this fruit tree Amang”.
                            And the strange man replied,” in our village we call that fruit LUKBAN, and I came
                            here to asked favor because my wife is pregnant and she wanted to eat LUKBAN but
                            there is no such fruit in our yard nor in our village this time. My father have told me
                            that I must come here to asked some for my wife”, begged the strange man. The old
                            man said, “I’ll give you some and we are grateful to you for knowing the name of this
                            tree. From now on, we shall call this tree Lukban”. The strange man thanked the
                            couple and joyfully headed towards home. <br> <br>
                            At that time, the village has no name yet. So, because of the abundance of
                            that amazing LUKBAN fruit in the village, the villagers named the village after the
                            fruit LUKBAN. Until such time that the village became bigger and more populous. As
                            melting pot of different visitors and traders, different people flocked and settled in the
                            village. Due to differences in dialect, some has called the place Kalukban (meaning a
                            place of many Lukban) while others remained to call it “Lukban”. After the lapsed of
                            time, the name of the village phonetically metamorphosed into Lukbuban until it was
                            officially registered as Barangay Lucbuban.</p>
                            <h1 class="mt-4">
                                VISION
                            </h1>
                            <p class="mt-2">
                                We envision Barangay Lucbuban as a progressive,
    clean and peaceful community with healthy, well-
    informed, participative and God-fearing residents
    led by dedicated and transparent leaders.
                            </p>
                            <h1 class="mt-4">
                                MISSION
                            </h1>
                            <p class="mt-2">
                                <span>We are committed to:</span>
                                <ul>
                                    <li>Improve the quality of government services,
                                        programs and legislation;</li>
                                    <li>Ensure peace, public order and safety;</li>
                                    <li>Improve quality of life of residents;</li>
                                    <li>Practice transparent leadership;</li>
                                    <li>Promote good health and nutrition and sanitation
                                        and;</li>
                                    <li>Improve the Quenbandiw and Ticlob Falls as
                                        tourist spot.</li>
                                </ul>
                            </p>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </div>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @yield('admin-scripts')
</body>
</html>
