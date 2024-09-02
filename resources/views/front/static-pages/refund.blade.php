@extends('front.layouts.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Refund Policy</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-10">
            <div class="container">
                <div class="section-title mt-5">
                    <h2>Refund Policy</h2>
                </div>
                <div class="content">
                    <h4>1. Overview</h4>
                    <p>At NexaMart, customer satisfaction is our top priority. If you are not entirely satisfied with your purchase, we’re here to help. This Refund Policy explains the terms under which you may request a refund or return a product.</p>

                    <h4>2. Returns</h4>
                    <p>You have [number] days to return an item from the date you received it. To be eligible for a return, your item must be unused and in the same condition that you received it. Your item must be in the original packaging, and you will need to provide the receipt or proof of purchase.</p>

                    <h4>3. Non-Returnable Items</h4>
                    <p>Certain items are exempt from being returned. These include:</p>
                    <ul>
                        <li>Perishable goods such as food, flowers, newspapers, or magazines.</li>
                        <li>Intimate or sanitary goods, hazardous materials, or flammable liquids or gases.</li>
                        <li>Personalized or custom-made products.</li>
                        <li>Downloadable software or digital products.</li>
                        <li>Gift cards and promotional items.</li>
                    </ul>

                    <h4>4. Refunds</h4>
                    <p>Once we receive your item, we will inspect it and notify you of the status of your refund. If your return is approved, we will initiate a refund to your original method of payment. The time it takes for the refund to be processed will depend on your card issuer’s policies.</p>

                    <h4>5. Late or Missing Refunds</h4>
                    <p>If you haven’t received a refund yet, first check your bank account again. Then contact your credit card company; it may take some time before your refund is officially posted. If you’ve done all of this and you still have not received your refund, please contact us at <a href="mailto:imtyazit17017@gmail.com">imtyazit17017@gmail.com</a>.</p>

                    <h4>6. Sale Items</h4>
                    <p>Only regular-priced items may be refunded. Sale items are non-refundable unless they arrive damaged or defective.</p>

                    <h4>7. Exchanges</h4>
                    <p>We only replace items if they are defective or damaged. If you need to exchange an item for the same product, contact us at <a href="mailto:imtyazit17017@gmail.com">imtyazit17017@gmail.com</a> and send your item to: Dhaka-106, Bangladesh.</p>

                    <h4>8. Shipping Returns</h4>
                    <p>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>

                    <h4>9. Contact Us</h4>
                    <p>If you have any questions about our Refund Policy, please contact us:</p>
                    <address>
                        Dhaka-106, Bangladesh<br>
                        <a href="tel:+8801315781010">+880 1315-781010</a><br>
                        <a href="mailto:imtyazit17017@gmail.com">imtyazit17017@gmail.com</a>
                    </address>
                </div>
            </div>
        </section>
    </main>
@endsection
