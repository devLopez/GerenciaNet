<?php

namespace Igrejanet\GerenciaNet;

class Igrejanet
{
    protected $accountId;

    protected $sandbox;

    public function __construct($accountId, $sandbox)
    {
        $this->accountId    = $accountId;
        $this->sandbox      = $sandbox;
    }

    public function generateScript()
    {
        $host = ($this->sandbox) ? 'https://sandbox.gerencianet.com.br' : 'https://api.gerencianet.com.br';

        return '<script type="text/javascript">
                    var s=document.createElement("script");
                    s.type="text/javascript";
                    var v=parseInt(Math.random()*1000000);
                    s.src="'.$host.'/v1/cdn/'.$this->accountId.'/"+v;
                    s.async=false;
                    s.id="'.$this->accountId.'";
                    if(!document.getElementById("'.$this->accountId.'")){
                        document.getElementsByTagName("head")[0].appendChild(s);
                    };
                    $gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};
                </script>';
    }
}