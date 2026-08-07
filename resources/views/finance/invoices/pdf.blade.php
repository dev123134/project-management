<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            padding: 25px;
        }

        .watermark {
            position: fixed;
            top: 42%;
            left: 18%;
            font-size: 90px;
            color: #eeeeee;
            transform: rotate(-35deg);
            opacity: .25;
            z-index: -1;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .outer {
            border: 1px solid #000;
        }

        .outer td {
            border: 1px solid #000;
            padding: 8px 10px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
            padding: 2px 0;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 10px 0;
            letter-spacing: 1px;
        }

        .company-name {
            font-size: 15px;
            font-weight: bold;
        }

        .muted {
            color: #444;
        }

        .section-label {
            font-weight: bold;
            padding-bottom: 4px;
        }

        .items {
            width: 100%;
            table-layout: fixed;
        }

        .items th {
            background: #f2f2f2;
            border: 1px solid #000;
            padding: 6px 6px;
            font-size: 11px;
            text-align: left;
            word-wrap: break-word;
        }

        .items td {
            border: 1px solid #000;
            padding: 6px 6px;
            font-size: 11px;
            word-wrap: break-word;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 11px;
        }

        .grand-total-row td {
            font-weight: bold;
            font-size: 13px;
            background: #f2f2f2;
        }

        .footer-note {
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-top: 15px;
        }

        .sig-box {
            height: 60px;
        }

        h4 {
            font-size: 12px;
            margin-bottom: 4px;
        }

        ul {
            padding-left: 16px;
        }

        li {
            font-size: 11px;
            line-height: 18px;
        }
    </style>
</head>

<body>

    <div class="watermark">{{ strtoupper($invoice->status) }}</div>

    <div class="title">TAX INVOICE</div>

    <table class="outer">
        <!-- Company + Invoice meta -->
        <tr>
            <td width="55%">
                <table class="no-border">
                    <tr>
                        <td width="60"><img src="{{ $logo }}" width="50"></td>
                        <td>
                            <div class="company-name">RMS CONNECT 360</div>
                            <div class="muted">Project Management System</div>
                        </td>
                    </tr>
                </table>
                <div class="muted" style="margin-top:6px;line-height:17px;">
                    GSTIN : 24ABCDE1234F1Z5<br>
                    PAN : ABCDE1234F<br>
                    State : Gujarat<br>
                    Bhuj, Gujarat - India<br>
                    Email : support@rmsconnect360.com<br>
                    Contact : +91 99999 99999
                </div>
            </td>
            <td width="45%">
                <table class="no-border">
                    <tr>
                        <td width="50%">Invoice No.</td>
                        <td><strong>{{ $invoice->invoice_number }}</strong></td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td>{{ date('d-M-Y', strtotime($invoice->invoice_date)) }}</td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td>{{ date('d-M-Y', strtotime($invoice->due_date)) }}</td>
                    </tr>
                    <tr>
                        <td>PO Number</td>
                        <td>{{ $invoice->po_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>PO Date</td>
                        <td>
                            @if($invoice->po_date)
                                {{ date('d-M-Y', strtotime($invoice->po_date)) }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><span class="status-badge">{{ strtoupper($invoice->status) }}</span></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Buyer / Bill To -->
        <tr>
            <td width="55%">
                <div class="section-label">BUYER DETAILS</div>
                <strong>{{ $invoice->project->client->name ?? '-' }}</strong><br>
                {{ $invoice->project->billing_address ?? '-' }}<br>
                Service : {{ $invoice->project->title ?? '-' }}
            </td>
            <td width="45%">
                <div class="section-label">BILL TO</div>
                <strong>{{ $invoice->project->client->name ?? 'Client Name' }}</strong><br>
                {{ $invoice->project->billing_address ?? '-' }}<br>
                {{ $invoice->project->service_location ?? '-' }}<br>
                {{ $invoice->project->nature_of_work ?? '-' }}
            </td>
        </tr>

        <!-- Items -->
        <tr>
            <td colspan="2" style="padding:0;">
                <table class="items">
                    <thead>
                        <tr>
                            <th width="32%">Description</th>
                            <th width="12%">HSN/SAC</th>
                            <th width="8%">Qty</th>
                            <th width="10%">Unit</th>
                            <th width="14%">Rate</th>
                            <th width="10%">GST %</th>
                            <th width="14%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoice->items as $item)
                            <tr>
                                <td>{{ $item->description }}</td>
                                <td class="center">{{ $item->hsn_code ?? '-' }}</td>
                                <td class="center">{{ $item->quantity }}</td>
                                <td class="center">{{ $item->unit ?? '-' }}</td>
                                <td class="right">₹ {{ number_format($item->unit_price, 2) }}</td>
                                <td class="center">{{ number_format($item->tax_percentage, 2) }}%</td>
                                <td class="right">₹ {{ number_format($item->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="center">No Invoice Items Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- Notes + Totals -->
        <tr>
            <td width="55%">
                <div class="section-label">Notes</div>
                <div style="min-height:50px;">{{ $invoice->notes ?? 'No Notes Available' }}</div>
            </td>
            <td width="45%" style="padding:0;">
                <table class="no-border" style="padding:8px 10px;">
                    <tr>
                        <td>Subtotal</td>
                        <td class="right">₹ {{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Tax </td>
                        <td class="right">₹ {{ number_format($invoice->tax_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Discount (-)</td>
                        <td class="right">₹ {{ number_format($invoice->discount, 2) }}</td>
                    </tr>
                    <tr class="grand-total-row">
                        <td>GRAND TOTAL</td>
                        <td class="right">₹ {{ number_format($invoice->grand_total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Amount in words -->
        <tr>
            <td colspan="2">
                <div class="section-label">Amount in Words</div>
                ₹ {{ number_format($invoice->grand_total, 2) }} Rupees Only
            </td>
        </tr>

        <!-- Bank details -->
        <tr>
            <td width="55%">
                <div class="section-label">Bank Details</div>
                <table class="no-border">
                    <tr>
                        <td width="40%">Account Name</td>
                        <td>RMS CONNECT 360</td>
                    </tr>
                    <tr>
                        <td>Bank Name</td>
                        <td>State Bank of India</td>
                    </tr>
                    <tr>
                        <td>Account No</td>
                        <td>123456789012</td>
                    </tr>
                    <tr>
                        <td>IFSC Code</td>
                        <td>SBIN0001234</td>
                    </tr>
                    <tr>
                        <td>Branch</td>
                        <td>Ahmedabad</td>
                    </tr>
                </table>
            </td>
            <td width="45%">
                <div class="section-label">Payment Terms</div>
                Payment is due before the invoice due date. Thank you for choosing RMS Connect 360.
            </td>
        </tr>

        <!-- Declaration + Signature -->
        <tr>
            <td width="60%">
                <div class="section-label">Declaration</div>
                We declare that this invoice shows the actual value of the services rendered and that all
                particulars furnished above are true and correct.
                <div class="section-label" style="margin-top:8px;">Terms &amp; Conditions</div>
                <ul>
                    <li>Payment should be made on or before the Due Date.</li>
                    <li>Late payment may attract additional charges.</li>
                    <li>This invoice is generated electronically.</li>
                    <li>Subject to Gujarat Jurisdiction.</li>
                </ul>
            </td>
            <td width="40%" class="center">
                <div class="sig-box"></div>
                @if(file_exists(public_path('images/signature.png')))
                    <img src="{{ public_path('images/signature.png') }}" width="110">
                @endif
                <div style="border-top:1px solid #000;margin-top:6px;padding-top:4px;">
                    <strong>Authorized Signatory</strong><br>
                    RMS CONNECT 360
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-note">This is a Computer Generated Invoice.</div>

</body>

</html>