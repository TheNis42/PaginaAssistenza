<?php 
    function selMacAttiviDett()
    {return "SELECT T_TestContratti.CodCliente, T_DettContratti.CodMacchina, T_TipoCont.Descrizione AS DescTipoContr
        FROM T_TestContratti INNER JOIN (T_DettContratti LEFT JOIN T_TipoCont ON T_DettContratti.TipoContratto = T_TipoCont.Codice) ON T_TestContratti.ID = T_DettContratti.IdTest
        WHERE T_DettContratti.FlagAttivo = 1
        GROUP BY T_TestContratti.CodCliente, T_DettContratti.CodMacchina, T_TipoCont.Descrizione";
    }
    
    function selCodMacChiam()
    {return "SELECT T_Macchine.Codice, T_Macchine.CodModello AS Modello, T_Macchine.CodCliente AS Cliente, Q_Clienti.Ragione_Sociale, Q_SelMacCliAttiviDett.DescTipoContr
    FROM (T_Macchine LEFT JOIN Q_Clienti ON T_Macchine.CodCliente = Q_Clienti.Codice_Anagrafica) INNER JOIN (".selMacAttiviDett().") AS Q_SelMacCliAttiviDett ON T_Macchine.Codice = Q_SelMacCliAttiviDett.CodMacchina";
    }


    function hfyuuy(){
        return "SELECT ANAGRAFICHECOMUNI.Codice_Anagrafica, ANAGRAFICHECOMUNI.Ragione_Sociale, ANAGRAFICHECOMUNI.Localita, ANAGRAFICHECOMUNI.Indirizzo, ANAGRAFICHECOMUNI.Provincia, ANAGRAFICHECOMUNI.Telefono
        FROM ANAGRAFICHECOMUNI INNER JOIN CLIENTIFORNITORI ON ANAGRAFICHECOMUNI.Codice_Anagrafica = CLIENTIFORNITORI.Codice_Cli_For
        WHERE (((CLIENTIFORNITORI.Ind_ClienteFornitore)='C'))";
    }



    
    ?>
            