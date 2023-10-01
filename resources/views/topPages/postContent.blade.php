@foreach($articles as $article)
        <!-- About section two-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">{{ $article->title }}</h2>
                        <p class="lead fw-normal text-muted mb-0">{{ $article->body }}</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section one-->
        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">{{ $article->title }}</h2>
                        <p class="lead fw-normal text-muted mb-0">{{ $article->body }}</p>
                    </div>
                </div>
            </div>
        </section>
        @endforeach



