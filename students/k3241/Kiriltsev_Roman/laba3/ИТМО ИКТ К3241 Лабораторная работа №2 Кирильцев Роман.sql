ALTER TABLE ONLY public."Zakaz_pechati"
    ADD CONSTRAINT tipografia_title_fk FOREIGN KEY (tipografia_title) REFERENCES public."Tipografia"(tipografia_title) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;
