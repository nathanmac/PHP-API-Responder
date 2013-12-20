# PHP-API-Responder-Library

Convert a PHP arrays into a range of common API response formats.

- XML
- JSON
- Query String
- YAML
- Serialized PHP Object

### Examples
##### JSON
<pre>
include_once 'Responder.php';

$responder = new Responder();

$payload = array(
  'parameters' => array(
    'id' => 1231
  ),
  'data' => array(
    'message' => 'Hello World'
  )
);

header('Content-Type: application/json');
header('HTTP/1.1: ' . 200);
header('Status: ' . 200);

echo $responder->to_json($payload);
</pre>
###### OUTPUT
<pre>
{
    "Response": {
        "parameters": {
            "id": 1231
        },
        "data": {
            "message": "Hello World"
        }
    }
}
</pre>

##### XML
<pre>
include_once 'Responder.php';

$responder = new Responder();

$payload = array(
  'parameters' => array(
    'id' => 1231
  ),
  'data' => array(
    'message' => 'Hello World'
  )
);

header('Content-Type: application/xml');
header('HTTP/1.1: ' . 200);
header('Status: ' . 200);

echo $responder->to_xml($payload);
</pre>
###### OUTPUT
<pre>
&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;Response&gt;
  &lt;parameters&gt;
    &lt;id&gt;1231&lt;/id&gt;
  &lt;/parameters&gt;
  &lt;data&gt;
    &lt;message&gt;Hello World&lt;/message&gt;
  &lt;/data&gt;
&lt;/Response&gt;
</pre>
