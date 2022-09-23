@extends('frontend.layouts.default')

@section('content')
    <section class="py-4 pt-0">
        <div class="container">
            <div class="row gx-5">
                <!----- left panel--->
                <div class="col-md-8">
                    <div class="pt-4">
                        <div class="card">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @for ($n = 0; $n < 3; $n++)
                                        <div class="carousel-item active">
                                            <img src="https://picsum.photos/1080/580" class="rounded w-100" />
                                        </div>
                                    @endfor
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>


                        </div>

                        <div class="py-4">
                            @for ($n = 0; $n < 3; $n++)
                                <span class="badge rounded-pill bg-info fs-6 fw-normal">Secondary</span>
                            @endfor
                        </div>

                        <div>
                            <h4>Description</h4>
                            <p>Catch the 'O Sanam' hitmaker Lucky Ali perform live at the SteppinOut Indie Fest along with
                                the best of Indie Artists pan India. With Dikshant who is the soulful voice behind the
                                popular song "Tum Akhon Se Batana", Lost Stories - one of the biggest name in Dance Music in
                                India and South Asia, Jaden Maskie Goa-Based Singer-Songwriter who wears many hats as an
                                artist, apart from writing and producing his own music, the singer-songwriter also mixes and
                                masters his tunes. Micah Bedford is an upcoming Hip- Hop/R&B artist who's been making waves
                                since March, 2020. Arham Fulfagar is a singer-songwriter originally from Guwahati, Assam
                                currently based out of Mumbai and has started releasing his songs this year. His music stems
                                out of his personal experiences and he is inspired by artists like Damien Rice, Ray
                                LaMontagne Leonard Cohen, Bharat Chauhan, Prateek Kuhad and more.</p>
                            <p>Soak in the beauty of musical transcendence and immerse yourself in the joy of pure music.
                                The SteppinOut Indie fest is all set to be a mixed bag of entertainment with music, food,
                                and an interesting line-up of budding indie artists who’d take you on a journey to your
                                soul.</p>
                            <p>From unlimited jam sessions, enriching musical banter, groovy tunes, soulful melody, and all
                                that jazz- The Indie fest is about to be epic. So get ready to meet your favorite artists,
                                or simply find one.</p>
                        </div>

                        <div class="mt-5">
                            <h4>Artists</h4>

                            @for ($n = 0; $n < 2; $n++)
                                <div class="card card-body mt-5">
                                    <div class="row align-items-end">
                                        <div class="col-auto">
                                            <div style="margin-top: -40px;">
                                                <img src="https://i.pravatar.cc/60?id={{}}"
                                                    class="rounded border" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <strong> Emiway Bantai</strong>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="mb-0">Emiway Bantai is a singer, rapper (Hip-Hop/Rap/RnB/PoP), dancer,
                                            songwriter, editor, and music composer. </p>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="mt-5">
                            <h4>Terms & Conditions</h4>
                            <ul class="list">
                                <li>Venue and club rules apply.</li>
                                <li>Strict COVID-19 Safety Protocols apply.</li>
                                <li>Organiser/venue reserves the right to deny entry at any time as a precautionary measure
                                    to uphold the highest level of health and safety for everyone.</li>
                                <li>Temperature checks might be taken by any of the venue/restaurant representatives prior,
                                    during, and after, in the club. The event organiser/venue will make a decision on access
                                    to the restaurant/venue based on your health conditions</li>
                                <li>Do not buy tickets from anyone except online on skillboxes.com</li>
                                <li>Please remember to carry a valid government-issued photo ID proof (Driver's
                                    License/Aadhar Card/PAN Card/Voter Card/Passport). You may not be permitted to enter in
                                    the absence of one.</li>
                                <li>The venue and schedule are subject to change.</li>
                                <li>This ticket permits entry to the event venue only. Any pre or after parties may have
                                    other ticketing requirements and may be sold separately.</li>
                                <li>Security procedures, including frisking, remain the right of the management.</li>
                                <li>No refund/replacement on a purchased ticket. Tickets you purchase are for personal use.
                                    You must not transfer (or seek to transfer) the tickets in breach of the applicable
                                    terms. A breach of this condition will entitle us to cancel the tickets without prior
                                    notification, refund, compensation or liability.</li>
                                <li>Please do not carry dangerous or potentially hazardous objects including but not limited
                                    to weapons, knives, guns, fireworks, laser devices and bottles to the venue. We may have
                                    to eject these things (with or without you) from the venue.</li>
                                <li>The sponsors/bands/organizers/management are not responsible for, including but not
                                    limited to, any injury or damage that may occur during or at the event.</li>
                                <li>No liability or claims that may arise due to the consumption or intake of any food or
                                    drink or any other consumption will be entertained by the management.</li>
                                <li>Parking near or at the event premises is at the risk of the vehicle owner.</li>
                                <li>The holder of this ticket grants organizers the right to use, in perpetuity, all or any
                                    part of the recording of any video or still footage made of the holder's appearance on
                                    any channel or magazine for broadcast in any and all media globally and for advertising,
                                    publicity and promotions relating hereto without any further approval of theirs.</li>
                                <li>The management reserves the exclusive right without refund or other recourse, to refuse
                                    admission to anyone who is found to be in breach of these terms and conditions
                                    including, if necessary, ejecting the holder/s of the ticket from the venue after they
                                    have entered the premises.</li>
                            </ul>
                        </div>
                    </div>

                </div>


                <!-- Right Panel -->
                <div class="col-md-4">
                    <div class="sticky-top pt-4">
                        <div class="card">
                            <div class="p-4 pb-3">
                                <div class="d-flex">
                                    <h4 class="flex-grow-1">Disco Dandiya Night | Navratri 2022</h4>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary"><i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="pb-2 pt-2 d-flex">
                                    <div><i class="fas fa-bookmark"></i></div>
                                    <div class="flex-grow-1 ps-3">Music</div>
                                </div>

                                <div class="pb-2 d-flex">
                                    <div><i class="fas fa-calendar"></i></div>
                                    <div class="flex-grow-1 ps-3">September 24 | 5PM</div>
                                </div>

                                <div class="d-flex">
                                    <div><i class="fa-solid fa-location-dot"></i></div>
                                    <div class="flex-grow-1 ps-3">Phoenix Marketcity, Bengaluru</div>
                                </div>
                            </div>

                            <div class="px-4 py-2 bg-light text-info">
                                <div class="d-flex">
                                    <div><i class="fa-solid fa-shoe-prints"></i></div>
                                    <div class="flex-grow-1 ps-3">Step out and enjoy this event</div>
                                </div>
                            </div>

                            <div class="p-4 pt-3 d-flex">
                                <div class="fs-4"><i class="fas fa-wallet"></i> </div>
                                <div class="flex-grow-1 ps-3 fs-4 fw-bold">@money(99)</div>
                                <div>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Book Now</button>
                                </div>

                            </div>
                        </div>

                        <div class="card mt-4 card-body">
                            <h5>Event Guide</h5>
                            <hr />
                            <div class="d-flex">
                                <div class="fs-3 text-secondary"><i class="fa-solid fa-person-walking"></i></div>
                                <div class="flex-grow-1 ps-4">
                                    <small class="text-muted mb-0 d-flex">For Age</small>
                                    <span>15+</span>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="fs-3 text-secondary"><i class="fa-solid fa-globe"></i></div>
                                <div class="flex-grow-1 ps-4">
                                    <small class="text-muted mb-0 d-flex">Language</small>
                                    <span>Hinglish</span>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <div class="fs-3 text-secondary"><i class="fa-solid fa-microphone-lines"></i></div>
                                <div class="flex-grow-1 ps-4">
                                    <small class="text-muted mb-0 d-flex">Live Performance</small>
                                    <span>Enjoy a unique experience</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-secondary text-light">
        <div class="container my-4">
            <div class="row align-items-center gx-5 gy-5">
                <div class="col-md-6">
                    <h2>No More Screens. Only LIVE Scenes.</h2>
                    <p class="mt-4 fs-5">Kiss the couch goodbye and make a checklist of the things you’ve missed! Concerts.
                        Comedy. Cricket. Camping. Cool Scenes.</p>
                    <p class="mt-4 fs-5">Set your destination to: ‘Anywhere, but home.’ Find experiences in & around your
                        city
                        - Step out with the Paytm Insider app today.</p>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <img src="https://media.insider.in/image/upload/c_crop,g_custom/v1637927732/pkle4f1xuhlf5kfwlcvg.gif"
                        style="width: 100%;" />
                </div>
            </div>
        </div>
    </section>

    <!------- Booking Modal ---->
    <div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content position-relative">
                    <button type="button" class="btn-close position-absolute" style="top: 5px; right:5px" aria-label="Close" data-bs-dismiss="modal"></button>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md">
                                <div>
                                    <div>
                                        <h4 class="mb-0">Emiway Bantai Live @ The LaLiT, Mumbai</h4>
                                        <small class="text-muted"><i class="fas fa-calendar me-2"></i> 16th October, 2022
                                            |
                                            04:00 PM Onwards</small>
                                    </div>
                                    <table class="table table-ms mt-3">
                                        @for ($n = 0; $n < 3; $n++)
                                            <tr>
                                                <td class="ps-0">
                                                    <h6 class="mb-0">Phase 2 - General Access</h6>
                                                    <small class="text-muted">Permits Entry to the Event Arena (GA Access
                                                        Area)
                                                        Permits Entry to the Event Arena.</small><br>
                                                    <span class="text-success"> @money(1000) </span>
                                                </td>
                                                <td width="1%" class="align-middle">
                                                    <input type="number" class="form-control form-control-small"
                                                        placeholder="Qtde." style="min-width: 80px" />
                                                </td>
                                                <td class="fs-6 align-middle pe-0">
                                                    @money(0)
                                                </td>
                                            </tr>
                                        @endfor
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-auto d-none d-md-inline">
                                <div class="d-flex" style="min-height: 300px;">
                                    <div class="vr"></div>
                                  </div>
                            </div>

                            <div class="col-md-auto">
                                <table class="table fs-6" style="min-width: 250px">
                                    <tr>
                                        <td class="ps-0 border-bottom-0">Total Quantity</td>
                                        <td class="pe-0 border-bottom-0">0</td>
                                    </tr>

                                    <tr>
                                        <td class="ps-0">Total Amount</td>
                                        <td class="pe-0">@money(0)</td>
                                    </tr>

                                    <tr>
                                        <td class="ps-0 border-bottom-0">Grand Total</td>
                                        <td class="pe-0 border-bottom-0">@money(0)</td>
                                    </tr>
                                </table>
                                <div>
                                    <button class="btn btn-primary w-100">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
