
        <div class="invoice-row" style="margin-bottom: 1rem">
            <div class="invoice-col-6">
                <p>Declaration</p>
                <p>
                    ইংরেজি থেকে অনুবাদ করা হয়েছে-প্রকাশনা এবং গ্রাফিক ডিজাইনে, লরেম ইপসাম হ'ল একটি স্থানধারক পাঠ্য যা সাধারণত কোনও দস্তাবেজের ভিজ্যুয়াল ফর্ম বা কোনও
                </p>
            </div>

            <div class="invoice-col-6 text-right">
                For XYZ Hospital Pharmacy
            </div>
        </div>
        <div class="invoice-row">
            <div class="invoice-col-12 text-right">
                <p>Authorized Signature</p>
            </div>
        </div>

        <div class="invoice-row" style="margin-top: 1.5rem">
            <div class="invoice-col-12 text-center">
                <p style="text-decoration: underline">This is a Computer Generated Invoice</p>
            </div>
        </div>

        <div class="invoice-row" style="margin-top: 1.5rem">
            <div class="invoice-col-12 text-right">
                <p>Printed On: <strong>{{ date('j-M-Y', strtotime($sale->created_at)) }} at {{ date('H:i', strtotime($sale->created_at)) }}</strong></p>
            </div>
        </div>

</div>
</body>
</html>