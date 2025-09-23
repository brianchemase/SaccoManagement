<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manna Tech Newsletter</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Ensures rounded corners apply to image */
        }
        .header {
            background-color: #FFAA00;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            /* No top border-radius here as image will cover it */
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .hero-image {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
            display: block; /* Remove extra space below image */
        }
        .content {
            padding: 20px 30px;
            line-height: 1.6;
        }
        .content p {
            margin-bottom: 15px;
        }
        .section-title {
            color: #44B900;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 5px;
            margin-top: 25px;
            font-size: 18px;
        }
        .specifications ul {
            list-style-type: none;
            padding: 0;
        }
        .specifications ul li {
            background-color: #f9f9f9;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 5px;
        }
        .contact-info {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            margin-top: 25px;
        }
        .contact-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://i.ibb.co/0jD7ZGJZ/pic.png?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&h=300" alt="Pyrethrum Fields" class="hero-image" style="width: 100%; height: auto; border-radius: 5px 5px 0 0; margin: -30px -30px 30px -30px; display: block; max-width: none;">
       

        <div class="header">
            <h1>Manna Tech Limited</h1>
        </div>
               
        <div class="content">
            <br>
            <p>Dear {{ $name }},</p>
            <p>I am pleased to introduce Manna Tech Limited, a sustainable agriculture company revitalising Kenya’s pyrethrum sector. We are building a modern, integrated value chain - from seed innovation and farmer partnerships to processing of Pyrethrum Refined Extract (PRE) - to deliver reliable, high-quality natural insecticide products for regional and global markets. Our focus is on consistent supply, quality assurance and partnerships that strengthen the entire pyrethrum value chain.</p>

            <h2 class="section-title">Crude Oleoresin Extract (COR)</h2>
            <p>To support production flexibility and market responsiveness, Manna Tech is in the position to be a primary supplier of high-quality Crude Oleoresin Extract. This allows customers to supplement in-house production as needed to meet demand and maintain reliability for formulators.</p>

            <h2 class="section-title">Pyrethrum Refined Extract (PRE)</h2>
            <p>As part of our integrated model, Manna Tech is prepared to supply premium-grade Pyrethrum Refined Extract (PRE). With purity levels aligned to international standards, PRE is suited for use in high-value applications including agriculture, public health and consumer products. PRE supply is available under structured agreements to ensure consistency, compliance and export readiness.</p>

            <p>We believe a partnership with "company name" has the potential to enhance resilience and value creation across the regional pyrethrum value chain to benefit farmers, processors and end users alike. We would be pleased to explore this opportunity further and to align on specific areas of mutual benefit. Please let us know your availability for a virtual or in-person meeting at your convenience.</p>

            <h2 class="section-title">Crude Oleoresin Specifications & Pricing</h2>
            <div class="specifications">
                <ul>
                    <li><strong>Pyrethrin Content W/W minimum:</strong> 25%</li>
                    <li><strong>Preservative:</strong> BHT added</li>
                    <li><strong>Packaging:</strong> 25kg drums</li>
                    <li><strong>Price:</strong> Available upon request, depending on volume & terms (excluding delivery)</li>
                    <li><strong>Current Stock:</strong> subject to order</li>
                </ul>
            </div>

            <h2 class="section-title">PRE Specifications & Pricing (illustrative)</h2>
            <div class="specifications">
                <ul>
                    <li><strong>Total Pyrethrin Content:</strong> ≥ 50% w/w</li>
                    <li><strong>Packaging:</strong> 25kg drums (or larger)</li>
                    <li><strong>Pricing:</strong> Available upon request, depending on volume & terms</li>
                    <li><strong>Export-ready, CoA and MSDS available</strong></li>
                </ul>
            </div>
        </div>
        <div class="contact-info">
            <p>Regards,</p>
            <p><strong>Wilfred Davies</strong></p>
            <p>Cofounder - Manna Tech Limited</p>
            <p>+254748480588</p>
            <p><a href="mailto:wilfred@mannatech.co.ke" style="color: #007bff; text-decoration: none;">wilfred@mannatech.co.ke</a></p>
        </div>
    </div>
</body>
</html>