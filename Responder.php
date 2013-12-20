<?php

class Responder {

    private function write(XMLWriter $xml, $data, $last_key = 'entity') {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                if (substr($last_key, -3) == 'ies') {
                    $key = substr($last_key, 0, -3) . 'y';
                } else if (substr($last_key, -1) == 's') {
                    $key = substr($last_key, 0, -1);
                } else {
                    $key = $last_key;
                }
            }
            
            if (is_array($value)) {
                $xml->startElement($key);
                $this->write($xml, $value, $key);
                $xml->endElement();
                continue;
            }
            if ($key[0]=='@') {
                @$xml->writeAttribute(substr($key, 1), ($value==='') ? null: $value);
            }else {
                @$xml->writeElement($key, ($value==='') ? null: $value);
            }
        }
    }

    public function to_xml($data, $startElement = 'Response', $xml_version = '1.0', $xml_encoding = 'UTF-8') {
        if (!is_array($data)) {
            return false; //return false error occurred
        }
        $xml = new XmlWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument($xml_version, $xml_encoding);
        $xml->startElement($startElement);
            
        $this->write($xml, $data);

        $xml->endElement();
        return $xml->outputMemory(true);
    }

    public function to_json($payload, $startElement = 'Response') {
        return json_encode(array($startElement => $payload), JSON_PRETTY_PRINT);
    }

    public function to_yaml($payload, $startElement = 'Response') {
        return yaml_emit(array($startElement => $payload));
    }

    public function to_serial($payload, $startElement = 'Response') {
        return serialize(array($startElement => $payload));
    }

    public function to_querystr($payload, $startElement = 'Response') {    
        return http_build_query(array($startElement => $payload));
    }    
}