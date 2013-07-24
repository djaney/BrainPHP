<?php

include 'brain.class.php';

// json from brain.js
$andNNJson = '{"layers":[{"a":{},"b":{}},{"0":{"bias":-0.9304201268731568,"weights":{"a":1.4386319069309457,"b":1.1801561140587824}},"1":{"bias":1.7228361294684351,"weights":{"a":-1.5507588107210033,"b":-1.787127697791537}},"2":{"bias":3.3792098694605595,"weights":{"a":-2.5847180140892965,"b":-2.5872036859845307}}},{"and":{"bias":0.8781018177020697,"weights":{"0":3.2450208448036553,"1":-3.3006003936494595,"2":-5.627874897115502}}}]}';

$brain = new Brain($andNNJson);


echo '<h1> "AND" truth table by a neural network trained using brain.js</h1>';

$result = $brain->run(array('a'=>1,'b'=>1));
echo '1 AND 1 is '. $result['and']. ' which is approximately '.round($result['and']).'. '.(round($result['and'])==(1 && 1)?'CORRECT':'WRONG').'<br/>';

$result = $brain->run(array('a'=>1,'b'=>0));
echo '1 AND 0 is '. $result['and']. ' which is approximately '.round($result['and']).'. '.(round($result['and'])==(1 && 0)?'CORRECT':'WRONG').'<br/>';

$result = $brain->run(array('a'=>0,'b'=>1));
echo '0 AND 1 is '. $result['and']. ' which is approximately '.round($result['and']).'. '.(round($result['and'])==(0 && 1)?'CORRECT':'WRONG').'<br/>';

$result = $brain->run(array('a'=>0,'b'=>0));
echo '0 AND 0 is '. $result['and']. ' which is approximately '.round($result['and']).'. '.(round($result['and'])==(0 && 0)?'CORRECT':'WRONG').'<br/>';