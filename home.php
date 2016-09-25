<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Developer Test</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <section id="information"></section>
            <section id="code">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Currency</th>
                        <th>VAT Percentage</th>
                        <th>VAT</th>
                        <th>Price excl VAT</th>
                        <th>Price incl VAT</th>
                        <th>Quantity</th>
                        <th>Total VAT</th>
                        <th>Total excl VAT</th>
                        <th>Total incl VAT</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ( $prices as $price ): $quantity = 5 + ( $quantity * $quantity ) % 33; ?>
                        <tr>
                            <td><?php echo $price->name; ?></td>
                            <td><?php echo $price->currency; ?></td>
                            <td><?php echo $price->taxPercentage; ?></td>
                            <td><?php echo $price->getTax(); ?></td>
                            <td><?php echo $price->getPriceExclTax(1); ?></td>
                            <td><?php echo $price->getPrice(1); ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $price->getTax($quantity); ?></td>
                            <td><?php echo $price->getPriceExclTax($quantity); ?></td>
                            <td><?php echo $price->getPrice($quantity); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.0.0/markdown-it.min.js"></script>
    <script type="text/javascript">
        $.get('README.md', function(data) {
          var markdown = markdownit();
          $('#information').html( markdown.render(data)).find('h1').wrap('<div class="page-header"></div>');
        });
    </script>
</body>
</html>
