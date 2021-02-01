<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Imprimir </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <script type="text/javascript" src="{{asset('js/jquery-1.3.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-barcode-2.0.2.min.js')}}"></script>
    <script type="text/javascript">

        function generateBarcode(value,diva)
        {
            // var value = $("#barcodeValue").val();
            var btype = "code128";
            var renderer = "css";
            var quietZone = false;
            var settings = {
                output:renderer,
                bgColor: "#FFFF",
                color: "#000000",
                barWidth: "1",
                barHeight: "15",
                moduleSize: "5",
                posX: "10",
                posY: "20",
                addQuietZone: "1"
            };
            value = {code:value, rect: true};

            $(diva).html("").show().barcode(value, btype, settings);
        }
    </script>
    <script type="text/javascript">
        function imprimir()
        {
            window.print() ;
        }
    </script>
</head>
<body onLoad="imprimir();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" height="50">
    <tr align="center">
        <td><span id="{{"0".trim($codpatri)}}" ><?php echo "<script>generateBarcode('0".trim($codpatri)."','#0".trim($codpatri)."');</script>"?></span></td>
        <td width="5%">&nbsp;</td>
        <td><span id="{{"1".trim($codpatri)}}" ><?php echo "<script>generateBarcode('1".trim($codpatri)."','#1".trim($codpatri)."');</script>"?></span></td>
    </tr>
    <tr style="text-align:center; font-size:10px; top:auto;">
        <td>MDVLH {{$codd[0]->codd."-".$usu[0]->usu}}</td>
        <td>&nbsp;</td>
        <td>MDVLH {{$codd[0]->codd."-".$usu[0]->usu}}</td>
    </tr>
    <tr style="text-align:center; font-size:12px; ">
        <td>Exp N°: {{$exp."-".$anio."-F".$folios}}</td>
        <td>&nbsp;</td>
        <td>Exp N°: {{$exp."-".$anio."-F".$folios}}</td>
    </tr>
    <tr style="text-align:center; font-size:10px; ">
        <td>{{$fech." a las ".$ofi}}</td>
        <td>&nbsp;</td>
        <td>{{$fech." a las ".$ofi}}</td>
    </tr>
</table>
</body>
</html>