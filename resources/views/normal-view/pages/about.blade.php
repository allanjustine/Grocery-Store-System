@extends('normal-view.layout.base')

@section('title')
    | About Us
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="/images/bg2.png" alt="Grocery Store" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">About Us</h2>
                <p>Welcome to our grocery store, where quality meets convenience. We take pride in offering a diverse
                    selection of locally sourced fruits, vegetables, dairy, and pantry staples to elevate your everyday
                    meals.</p>

                <p>Our commitment to quality extends to every product on our shelves. From farm-fresh produce to carefully
                    curated grocery items, we strive to provide you with the finest selection at affordable prices.</p>
                <hr>

                <h4 class="mt-4">Customer Testimonial</h4>
                <blockquote class="blockquote">
                    <p class="mb-0">"I love shopping at this grocery store! The freshness of their produce is unmatched,
                        and their commitment to supporting local farmers is something I truly appreciate. The variety of
                        products ensures that I can find everything I need for my family."</p>
                    <br>
                    <footer class="blockquote-footer">- Jane Doe, Satisfied Customer</footer>
                </blockquote>
                <hr>

                <h4 class="mt-4">Our Success</h4>
                <p>Our success is driven by your satisfaction. We are proud to have become a trusted part of the community,
                    providing quality products that contribute to the success of countless meals and celebrations. As we
                    continue to grow, we remain dedicated to serving you with excellence.</p>

                <p>Thank you for choosing our grocery store. We look forward to continuing our journey together, bringing
                    you the best products and an exceptional shopping experience. Happy shopping!</p>
            </div>
        </div>
    </div>
@endsection
