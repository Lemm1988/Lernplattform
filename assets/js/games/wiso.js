/**
 * WiSo-Trainer: Wirtschafts- und Sozialkunde üben – Fallentscheidungen, Zahlen und Fristen,
 * Kündigungsfristen (§ 622 BGB), Urlaubsanspruch und Sozialversicherungsbeiträge.
 * Rechtsstand der Inhalte: 2026. Beitragssätze werden in den Aufgaben immer mit angegeben.
 */
(function () {
    'use strict';

    const { h, checkFields, numberInput, deFormat, mark, deck } = window.ITGame;
    const eur = (n) => deFormat(n, 2) + ' €';
    const r2 = (n) => Math.round(n * 100) / 100;

    // ---------- Datumshelfer (UTC, damit Sommerzeit nicht stört) ----------

    const datum = (y, m, d) => new Date(Date.UTC(y, m - 1, d));
    const plusTage = (dt, n) => new Date(dt.getTime() + n * 86400000);
    const tageImMonat = (y, m) => new Date(Date.UTC(y, m, 0)).getUTCDate();
    const monatsende = (dt) => datum(dt.getUTCFullYear(), dt.getUTCMonth() + 1, tageImMonat(dt.getUTCFullYear(), dt.getUTCMonth() + 1));
    function plusMonate(dt, n) {
        const y = dt.getUTCFullYear();
        const m = dt.getUTCMonth() + 1 + n;
        const zy = y + Math.floor((m - 1) / 12);
        const zm = ((m - 1) % 12) + 1;
        return datum(zy, zm, Math.min(dt.getUTCDate(), tageImMonat(zy, zm)));
    }
    const iso = (dt) => dt.toISOString().slice(0, 10);
    const de = (dt) => `${String(dt.getUTCDate()).padStart(2, '0')}.${String(dt.getUTCMonth() + 1).padStart(2, '0')}.${dt.getUTCFullYear()}`;
    const WOCHENTAG = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
    const deLang = (dt) => WOCHENTAG[dt.getUTCDay()] + ', ' + de(dt);
    const zufallsDatum = (rng, von, bis) => datum(rng.int(von, bis), rng.int(1, 12), 1 + rng.int(0, 27));
    const volleJahre = (von, bis) => {
        let j = bis.getUTCFullYear() - von.getUTCFullYear();
        if (bis.getUTCMonth() < von.getUTCMonth() || (bis.getUTCMonth() === von.getUTCMonth() && bis.getUTCDate() < von.getUTCDate())) j--;
        return j;
    };

    // ---------- Fallentscheidungen ----------

    const FAELLE = [
        { t: 'Ausbildung', f: 'Lena ist seit sechs Wochen in der Ausbildung (Probezeit vier Monate). Sie merkt, dass der Beruf nicht zu ihr passt, und möchte sofort aufhören.', o: ['Sie kann jederzeit ohne Kündigungsfrist schriftlich kündigen.', 'Sie muss vier Wochen Kündigungsfrist einhalten.', 'Sie braucht einen wichtigen Grund.', 'Sie kann erst nach der Probezeit kündigen.'], r: 0, e: 'In der Probezeit können beide Seiten das Ausbildungsverhältnis jederzeit ohne Frist kündigen (§ 22 Abs. 1 BBiG) – aber schriftlich.' },
        { t: 'Ausbildung', f: 'Nach der Probezeit möchte ein Ausbildungsbetrieb einem Azubi ordentlich mit vier Wochen Frist kündigen, weil die Auftragslage schlecht ist.', o: ['Das ist nicht möglich – der Betrieb kann nur noch fristlos aus wichtigem Grund kündigen.', 'Das ist möglich, wenn der Betriebsrat zustimmt.', 'Das ist mit der gesetzlichen Grundkündigungsfrist möglich.', 'Das ist nur mit Zustimmung der IHK möglich.'], r: 0, e: 'Nach der Probezeit kann der Ausbildende nur noch aus wichtigem Grund ohne Frist kündigen (§ 22 Abs. 2 Nr. 1 BBiG). Schlechte Auftragslage ist kein solcher Grund.' },
        { t: 'Ausbildung', f: 'Ein Azubi (nach der Probezeit) will die Ausbildung beenden, um eine Ausbildung zum Koch zu beginnen.', o: ['Er kann mit einer Frist von vier Wochen kündigen.', 'Er kann nicht kündigen, nur ein Aufhebungsvertrag ist möglich.', 'Er kann nur fristlos kündigen.', 'Er muss bis zum Ende des Ausbildungsjahres bleiben.'], r: 0, e: 'Wer die Berufsausbildung aufgeben oder sich für einen anderen Beruf ausbilden lassen will, kann mit vier Wochen Frist kündigen (§ 22 Abs. 2 Nr. 2 BBiG).' },
        { t: 'Ausbildung', f: 'Wie lange darf die Probezeit in einem Berufsausbildungsverhältnis dauern?', o: ['mindestens 1, höchstens 4 Monate', 'genau 3 Monate', 'höchstens 6 Monate', 'mindestens 2, höchstens 6 Monate'], r: 0, e: '§ 20 BBiG: Die Probezeit muss mindestens einen Monat und darf höchstens vier Monate betragen.' },
        { t: 'Ausbildung', f: 'Ein 19-jähriger Azubi hat dienstags sechs Unterrichtsstunden à 45 Minuten Berufsschule. Der Ausbilder verlangt, dass er danach noch in den Betrieb kommt.', o: ['Er muss nicht kommen: An einem solchen Berufsschultag pro Woche darf er nicht beschäftigt werden.', 'Er muss kommen, weil er volljährig ist.', 'Er muss kommen, die Zeit wird als Überstunde bezahlt.', 'Er muss nur kommen, wenn es im Ausbildungsvertrag steht.'], r: 0, e: 'Seit 2020 gilt die Regel für alle Azubis unabhängig vom Alter: An einem Berufsschultag mit mehr als fünf Unterrichtsstunden à 45 Minuten darf einmal pro Woche nicht im Betrieb beschäftigt werden (§ 15 BBiG).' },
        { t: 'Ausbildung', f: 'Was muss der Ausbildungsbetrieb einem Azubi kostenlos zur Verfügung stellen?', o: ['die Ausbildungsmittel, die für die Ausbildung und die Abschlussprüfung im Betrieb nötig sind', 'die Schulbücher für die Berufsschule', 'einen Dienstwagen für den Weg zur Berufsschule', 'einen privaten Laptop zur freien Verwendung'], r: 0, e: '§ 14 BBiG: Ausbildungsmittel, insbesondere Werkzeuge und Werkstoffe, die zur Berufsausbildung und zur Ablegung der Prüfungen erforderlich sind, stellt der Betrieb kostenlos.' },
        { t: 'Ausbildung', f: 'Ein Azubi besteht die Abschlussprüfung nicht. Was gilt?', o: ['Auf sein Verlangen verlängert sich die Ausbildung bis zur nächsten Wiederholungsprüfung, höchstens um ein Jahr.', 'Die Ausbildung endet automatisch, eine Wiederholung ist nicht möglich.', 'Der Betrieb muss ihn als Fachkraft übernehmen.', 'Er muss die gesamte Ausbildung neu beginnen.'], r: 0, e: '§ 21 Abs. 3 BBiG: Bei Nichtbestehen verlängert sich das Ausbildungsverhältnis auf Verlangen bis zur nächstmöglichen Wiederholungsprüfung, höchstens um ein Jahr.' },
        { t: 'Jugendarbeitsschutz', f: 'Ein 17-jähriger Azubi soll an einem Tag 9 Stunden arbeiten, weil ein Rollout ansteht.', o: ['Unzulässig – Jugendliche dürfen höchstens 8 Stunden täglich arbeiten (Ausnahme: 8,5 Stunden, wenn an anderen Tagen verkürzt).', 'Zulässig, wenn er zustimmt.', 'Zulässig, wenn die Stunde bezahlt wird.', 'Zulässig, da 10 Stunden die Grenze sind.'], r: 0, e: 'JArbSchG § 8: höchstens 8 Stunden täglich und 40 Stunden wöchentlich. Nur wenn an einzelnen Werktagen kürzer gearbeitet wird, sind bis zu 8,5 Stunden an anderen Tagen derselben Woche erlaubt.' },
        { t: 'Jugendarbeitsschutz', f: 'Ein 16-jähriger Azubi arbeitet 7 Stunden. Welche Pausen stehen ihm mindestens zu?', o: ['60 Minuten', '30 Minuten', '45 Minuten', '15 Minuten'], r: 0, e: 'JArbSchG § 11: mehr als 4,5 bis 6 Stunden → 30 Minuten, mehr als 6 Stunden → 60 Minuten Ruhepause. Eine Pause muss mindestens 15 Minuten dauern.' },
        { t: 'Arbeitszeit', f: 'Eine volljährige Mitarbeiterin arbeitet 9,5 Stunden. Welche Pause schreibt das Arbeitszeitgesetz mindestens vor?', o: ['45 Minuten', '30 Minuten', '60 Minuten', 'keine, solange sie zustimmt'], r: 0, e: 'ArbZG § 4: mehr als 6 Stunden → 30 Minuten, mehr als 9 Stunden → 45 Minuten Ruhepause.' },
        { t: 'Arbeitszeit', f: 'Ein Admin hat bis 23 Uhr ein Update eingespielt. Wann darf er frühestens wieder arbeiten?', o: ['um 10 Uhr am nächsten Tag', 'um 7 Uhr am nächsten Tag', 'um 8 Uhr am nächsten Tag', 'sofort, wenn er sich fit fühlt'], r: 0, e: 'ArbZG § 5: Nach Ende der täglichen Arbeitszeit ist eine ununterbrochene Ruhezeit von mindestens 11 Stunden einzuhalten.' },
        { t: 'Kündigung', f: 'Der Chef kündigt einem Mitarbeiter per E-Mail mit eingescannter Unterschrift.', o: ['Die Kündigung ist unwirksam – sie muss schriftlich mit eigenhändiger Unterschrift erfolgen.', 'Die Kündigung ist wirksam, weil die Unterschrift sichtbar ist.', 'Die Kündigung ist wirksam, wenn die E-Mail gelesen wurde.', 'Die Kündigung ist wirksam, wenn eine Lesebestätigung vorliegt.'], r: 0, e: '§ 623 BGB: Kündigung und Aufhebungsvertrag bedürfen der Schriftform; die elektronische Form ist ausgeschlossen. E-Mail, Fax oder Messenger reichen nicht.' },
        { t: 'Kündigung', f: 'Ein Betrieb mit 25 Beschäftigten kündigt einem Mitarbeiter, der seit drei Jahren dort arbeitet, ohne Begründung. Was gilt?', o: ['Das Kündigungsschutzgesetz greift – die Kündigung muss sozial gerechtfertigt sein.', 'Der Arbeitgeber muss nie einen Grund haben.', 'Kündigungsschutz gilt erst nach zehn Jahren Betriebszugehörigkeit.', 'Kündigungsschutz gilt nur für Gewerkschaftsmitglieder.'], r: 0, e: 'Das KSchG gilt, wenn das Arbeitsverhältnis länger als sechs Monate besteht und der Betrieb mehr als zehn Arbeitnehmer hat. Die Kündigung muss dann personen-, verhaltens- oder betriebsbedingt sein.' },
        { t: 'Kündigung', f: 'Ein Mitarbeiter kommt zum ersten Mal unentschuldigt zwei Stunden zu spät. Was ist die angemessene Reaktion des Arbeitgebers?', o: ['eine Abmahnung', 'eine fristlose Kündigung', 'eine ordentliche Kündigung', 'eine Kürzung des Urlaubs'], r: 0, e: 'Vor einer verhaltensbedingten Kündigung ist in der Regel eine Abmahnung nötig: Sie benennt das Fehlverhalten und droht für den Wiederholungsfall arbeitsrechtliche Konsequenzen an.' },
        { t: 'Kündigung', f: 'Ein Unternehmen mit Betriebsrat kündigt einer Mitarbeiterin, ohne den Betriebsrat vorher anzuhören.', o: ['Die Kündigung ist unwirksam.', 'Die Kündigung ist wirksam, der Betriebsrat kann nur nachträglich widersprechen.', 'Die Kündigung ist wirksam, wenn die Frist eingehalten wurde.', 'Die Kündigung wird erst nach einem Monat wirksam.'], r: 0, e: '§ 102 BetrVG: Der Betriebsrat ist vor jeder Kündigung zu hören. Eine ohne Anhörung ausgesprochene Kündigung ist unwirksam.' },
        { t: 'Kündigung', f: 'Eine Mitarbeiterin teilt ihrem Arbeitgeber mit, dass sie schwanger ist. Kurz darauf soll ihr betriebsbedingt gekündigt werden.', o: ['Das ist grundsätzlich verboten – während der Schwangerschaft und bis vier Monate nach der Entbindung besteht Kündigungsschutz.', 'Das ist erlaubt, wenn die Frist eingehalten wird.', 'Das ist erlaubt, wenn sie weniger als ein Jahr im Betrieb ist.', 'Das ist erlaubt, wenn der Betriebsrat zustimmt.'], r: 0, e: '§ 17 MuSchG: Kündigungsverbot während der Schwangerschaft und bis zum Ende von vier Monaten nach der Entbindung. Nur in besonderen Fällen kann die zuständige Behörde eine Kündigung ausnahmsweise zulassen.' },
        { t: 'Betriebsrat', f: 'Die Geschäftsleitung will eine Software einführen, die erfasst, wie lange jede Person an welchem Ticket arbeitet. Welche Rolle hat der Betriebsrat?', o: ['Mitbestimmung – ohne Zustimmung (oder Spruch der Einigungsstelle) darf die Software nicht eingeführt werden.', 'Er muss nur informiert werden.', 'Er kann nur eine Stellungnahme abgeben.', 'Er ist nicht zuständig, das entscheidet allein die IT.'], r: 0, e: '§ 87 Abs. 1 Nr. 6 BetrVG: Die Einführung technischer Einrichtungen, die geeignet sind, Verhalten oder Leistung zu überwachen, ist mitbestimmungspflichtig.' },
        { t: 'Betriebsrat', f: 'Ab welcher Größe kann in einem Betrieb ein Betriebsrat gewählt werden?', o: ['ab 5 ständigen wahlberechtigten Arbeitnehmern, von denen 3 wählbar sind', 'ab 10 Arbeitnehmern', 'ab 20 Arbeitnehmern', 'nur in Kapitalgesellschaften'], r: 0, e: '§ 1 BetrVG: in Betrieben mit in der Regel mindestens fünf ständigen wahlberechtigten Arbeitnehmern, von denen drei wählbar sind.' },
        { t: 'Betriebsrat', f: 'Ein 16-jähriger Azubi fragt, ob er bei der Betriebsratswahl wählen darf.', o: ['Ja, wahlberechtigt ist man ab 16 Jahren.', 'Nein, erst ab 18 Jahren.', 'Nein, Azubis dürfen gar nicht wählen.', 'Ja, aber nur die Jugend- und Auszubildendenvertretung.'], r: 0, e: 'Seit 2021 sind alle Arbeitnehmer ab 16 Jahren bei der Betriebsratswahl wahlberechtigt (§ 7 BetrVG). Wählbar (in den Betriebsrat gewählt werden) ist man ab 18.' },
        { t: 'Betriebsrat', f: 'Wann wird eine Jugend- und Auszubildendenvertretung (JAV) gewählt?', o: ['wenn mindestens 5 Arbeitnehmer unter 18 Jahren oder Auszubildende unter 25 Jahren im Betrieb sind und ein Betriebsrat besteht', 'in jedem Betrieb mit Auszubildenden', 'nur in Betrieben über 100 Beschäftigte', 'wenn die IHK das anordnet'], r: 0, e: '§ 60 BetrVG: In Betrieben mit mindestens fünf Jugendlichen oder Azubis unter 25 wird eine JAV gewählt – sie arbeitet mit dem Betriebsrat zusammen.' },
        { t: 'Tarifrecht', f: 'Während der Laufzeit eines Tarifvertrags ruft die Gewerkschaft zu einem Streik für höhere Löhne auf, obwohl die Löhne im laufenden Vertrag geregelt sind.', o: ['Das verstößt gegen die Friedenspflicht.', 'Das ist jederzeit zulässig.', 'Das ist zulässig, wenn die Inflation hoch ist.', 'Das ist zulässig, wenn der Arbeitgeberverband zustimmt.'], r: 0, e: 'Während der Laufzeit eines Tarifvertrags gilt die Friedenspflicht: Über die darin geregelten Punkte darf nicht gestreikt werden.' },
        { t: 'Tarifrecht', f: 'Der Tarifvertrag sieht 30 Urlaubstage vor, der Arbeitsvertrag eines Tarifbeschäftigten nur 26. Was gilt?', o: ['30 Tage – vom Tarifvertrag darf nur zugunsten des Arbeitnehmers abgewichen werden.', '26 Tage, weil der Arbeitsvertrag spezieller ist.', '28 Tage als Mittelwert.', '24 Tage, der gesetzliche Mindesturlaub.'], r: 0, e: 'Günstigkeitsprinzip: Abweichungen vom Tarifvertrag sind nur zulässig, wenn sie für den Arbeitnehmer günstiger sind.' },
        { t: 'Sozialversicherung', f: 'Ein Azubi verunglückt auf dem direkten Weg von der Berufsschule zum Betrieb. Welche Versicherung ist zuständig?', o: ['die gesetzliche Unfallversicherung (Berufsgenossenschaft)', 'die Krankenversicherung', 'die private Haftpflichtversicherung', 'die Rentenversicherung'], r: 0, e: 'Wegeunfälle auf dem direkten Weg zur Arbeit oder Berufsschule sind über die gesetzliche Unfallversicherung abgesichert. Träger sind die Berufsgenossenschaften.' },
        { t: 'Sozialversicherung', f: 'Wer zahlt die Beiträge zur gesetzlichen Unfallversicherung?', o: ['allein der Arbeitgeber', 'Arbeitgeber und Arbeitnehmer je zur Hälfte', 'allein der Arbeitnehmer', 'der Staat aus Steuermitteln'], r: 0, e: 'Die Unfallversicherung ist der einzige Zweig, den der Arbeitgeber allein finanziert.' },
        { t: 'Sozialversicherung', f: 'Ein Mitarbeiter ist krank. Wie lange zahlt der Arbeitgeber das Gehalt weiter?', o: ['bis zu 6 Wochen je Krankheit, danach Krankengeld der Krankenkasse', 'unbegrenzt', 'bis zu 3 Tage', 'bis zu 6 Monate'], r: 0, e: 'Entgeltfortzahlungsgesetz: Nach vier Wochen Beschäftigung zahlt der Arbeitgeber bis zu sechs Wochen das volle Entgelt. Danach zahlt die Krankenkasse Krankengeld.' },
        { t: 'Sozialversicherung', f: 'Welcher Zweig gehört NICHT zur gesetzlichen Sozialversicherung?', o: ['die Haftpflichtversicherung', 'die Pflegeversicherung', 'die Arbeitslosenversicherung', 'die Unfallversicherung'], r: 0, e: 'Die fünf Zweige sind Kranken-, Pflege-, Renten-, Arbeitslosen- und Unfallversicherung. Die Haftpflichtversicherung ist eine freiwillige Privatversicherung.' },
        { t: 'Geschäftsfähigkeit', f: 'Der 15-jährige Tim kauft von seinem Taschengeld ein gebrauchtes Smartphone für 120 €. Die Eltern sind dagegen.', o: ['Der Vertrag ist wirksam, wenn Tim mit eigenem Taschengeld sofort voll bezahlt hat.', 'Der Vertrag ist immer nichtig.', 'Der Vertrag ist immer schwebend unwirksam.', 'Der Vertrag ist wirksam, weil Tim über 14 ist.'], r: 0, e: 'Taschengeldparagraph § 110 BGB: Ein Vertrag eines beschränkt Geschäftsfähigen ist wirksam, wenn er die Leistung mit Mitteln bewirkt, die ihm zu diesem Zweck oder zur freien Verfügung überlassen wurden. Ratenkäufe fallen nicht darunter.' },
        { t: 'Geschäftsfähigkeit', f: 'Die 16-jährige Mia schließt ohne Wissen ihrer Eltern einen Handyvertrag mit 24 Monaten Laufzeit ab.', o: ['Der Vertrag ist schwebend unwirksam, bis die Eltern ihn genehmigen oder ablehnen.', 'Der Vertrag ist voll wirksam.', 'Der Vertrag ist von Anfang an nichtig.', 'Der Vertrag ist wirksam, aber Mia kann jederzeit kündigen.'], r: 0, e: 'Beschränkt Geschäftsfähige (7–17 Jahre) brauchen für Verträge, die nicht lediglich rechtlich vorteilhaft sind, die Zustimmung der gesetzlichen Vertreter. Bis zur Genehmigung ist der Vertrag schwebend unwirksam (§ 108 BGB).' },
        { t: 'Kaufvertrag', f: 'Ein Kunde kauft im Laden ein neues Notebook. Nach drei Monaten fällt das Display aus. Was kann er zuerst verlangen?', o: ['Nacherfüllung – nach seiner Wahl Reparatur oder ein neues Gerät', 'sofort sein Geld zurück', 'sofort einen Preisnachlass', 'nichts, die Garantie des Herstellers ist abgelaufen'], r: 0, e: 'Bei einem Mangel hat die Nacherfüllung Vorrang (§ 439 BGB). Erst wenn sie fehlschlägt oder verweigert wird, kommen Rücktritt, Minderung oder Schadensersatz in Frage.' },
        { t: 'Kaufvertrag', f: 'Ein Verbraucher reklamiert nach acht Monaten einen Defekt an einem neu gekauften Drucker. Wer muss beweisen, ob der Mangel schon beim Kauf vorlag?', o: ['Der Verkäufer – innerhalb eines Jahres wird vermutet, dass der Mangel schon bei Übergabe bestand.', 'Der Käufer, und zwar immer.', 'Niemand, die Gewährleistung ist abgelaufen.', 'Der Hersteller.'], r: 0, e: 'Beim Verbrauchsgüterkauf gilt seit 2022 eine Beweislastumkehr von einem Jahr ab Übergabe (§ 477 BGB).' },
        { t: 'Kaufvertrag', f: 'Was ist der Unterschied zwischen Gewährleistung und Garantie?', o: ['Gewährleistung ist gesetzlich und gilt gegenüber dem Verkäufer; eine Garantie ist eine freiwillige Zusage, meist des Herstellers.', 'Beides ist dasselbe.', 'Die Garantie ist gesetzlich, die Gewährleistung freiwillig.', 'Gewährleistung gibt es nur bei gebrauchten Waren.'], r: 0, e: 'Die gesetzliche Mängelhaftung (Gewährleistung) beträgt bei neuen Sachen zwei Jahre. Eine Garantie kann zusätzlich freiwillig gegeben werden, ihre Bedingungen legt der Garantiegeber fest.' },
        { t: 'Kaufvertrag', f: 'Eine Privatperson bestellt online einen Monitor. Wie lange kann sie den Vertrag ohne Angabe von Gründen widerrufen?', o: ['14 Tage ab Erhalt der Ware (bei ordnungsgemäßer Belehrung)', '7 Tage', '30 Tage', 'gar nicht, Kauf ist Kauf'], r: 0, e: 'Bei Fernabsatzverträgen haben Verbraucher ein Widerrufsrecht von 14 Tagen (§ 355 BGB). Zwischen Unternehmen gibt es dieses Recht nicht.' },
        { t: 'Rechtsformen', f: 'Zwei Freundinnen gründen ein IT-Systemhaus und wollen nicht mit ihrem Privatvermögen haften. Sie haben 25.000 € Startkapital.', o: ['GmbH', 'OHG', 'GbR', 'Einzelunternehmen (e. K.)'], r: 0, e: 'Bei der GmbH haftet nur das Gesellschaftsvermögen. Das Mindeststammkapital beträgt 25.000 €. Bei OHG und GbR haften alle Gesellschafter unbeschränkt mit ihrem Privatvermögen.' },
        { t: 'Rechtsformen', f: 'In einer KG haftet der Kommanditist …', o: ['nur bis zur Höhe seiner Einlage.', 'unbeschränkt mit seinem Privatvermögen.', 'gar nicht.', 'nur, wenn er Geschäftsführer ist.'], r: 0, e: 'In der KG haftet mindestens ein Komplementär unbeschränkt; Kommanditisten haften nur bis zur Höhe ihrer Einlage.' },
        { t: 'Rechtsformen', f: 'Ein Gründer möchte eine haftungsbeschränkte Gesellschaft, hat aber nur 1.000 € Kapital.', o: ['Unternehmergesellschaft (haftungsbeschränkt)', 'Aktiengesellschaft', 'GmbH', 'Kommanditgesellschaft'], r: 0, e: 'Die UG (haftungsbeschränkt) ist eine GmbH-Variante, die schon ab 1 € Stammkapital gegründet werden kann. Sie muss jährlich 25 % ihres Gewinns als Rücklage ansparen, bis 25.000 € erreicht sind.' },
        { t: 'Vollmachten', f: 'Ein Prokurist möchte das Betriebsgrundstück verkaufen. Darf er das?', o: ['Nein, dafür braucht er eine besondere Befugnis.', 'Ja, Prokura umfasst alle Geschäfte.', 'Ja, wenn der Kaufpreis unter 1 Million Euro liegt.', 'Nur mit Zustimmung des Betriebsrats.'], r: 0, e: 'Die Prokura deckt fast alle Geschäfte eines Handelsgewerbes, aber nicht die Veräußerung und Belastung von Grundstücken (§ 49 HGB). Sie wird ins Handelsregister eingetragen.' },
        { t: 'Vollmachten', f: 'Eine Teamleiterin darf laut Arbeitsvertrag Büromaterial und Kleinhardware für die Abteilung bestellen. Um welche Vollmacht handelt es sich?', o: ['Handlungsvollmacht (Art- bzw. Einzelvollmacht)', 'Prokura', 'Generalvollmacht', 'Gesamtprokura'], r: 0, e: 'Die Handlungsvollmacht (§ 54 HGB) deckt gewöhnliche Geschäfte im jeweiligen Betrieb – als Einzel-, Art- oder allgemeine Handlungsvollmacht. Sie wird nicht ins Handelsregister eingetragen.' },
        { t: 'Mahnung & Verjährung', f: 'Ein Kunde erhält einen gerichtlichen Mahnbescheid, hält die Forderung aber für unberechtigt. Was sollte er tun?', o: ['innerhalb von zwei Wochen Widerspruch einlegen', 'nichts, ein Mahnbescheid hat keine Folgen', 'sofort zahlen, sonst wird gepfändet', 'beim Betriebsrat Beschwerde einlegen'], r: 0, e: 'Gegen den Mahnbescheid kann innerhalb von zwei Wochen Widerspruch eingelegt werden. Ohne Widerspruch kann der Gläubiger einen Vollstreckungsbescheid beantragen – das ist ein vollstreckbarer Titel.' },
        { t: 'Mahnung & Verjährung', f: 'Eine Rechnung über eine IT-Dienstleistung wurde am 10. März 2025 fällig. Wann verjährt die Forderung regelmäßig?', o: ['mit Ablauf des 31.12.2028', 'am 10.03.2028', 'mit Ablauf des 31.12.2027', 'am 10.03.2030'], r: 0, e: 'Die regelmäßige Verjährungsfrist beträgt drei Jahre und beginnt mit dem Schluss des Jahres, in dem der Anspruch entstanden ist (§§ 195, 199 BGB): 31.12.2025 + 3 Jahre.' },
        { t: 'Arbeitsvertrag', f: 'Ein Mitarbeiter verlässt das Unternehmen und verlangt ein Zeugnis, das auch seine Leistung und sein Verhalten beurteilt.', o: ['Er hat Anspruch auf ein qualifiziertes Arbeitszeugnis.', 'Er hat nur Anspruch auf eine Arbeitsbescheinigung.', 'Ein Zeugnis gibt es nur nach zehn Jahren Betriebszugehörigkeit.', 'Der Arbeitgeber kann frei entscheiden, ob er ein Zeugnis ausstellt.'], r: 0, e: 'Arbeitnehmer haben Anspruch auf ein einfaches Zeugnis (Art und Dauer) oder auf Verlangen auf ein qualifiziertes Zeugnis mit Leistung und Verhalten (§ 109 GewO). Es muss wohlwollend und wahr sein.' },
        { t: 'Arbeitsvertrag', f: 'Welche Pflicht hat der Arbeitnehmer aus dem Arbeitsvertrag?', o: ['Arbeitspflicht und Verschwiegenheit über Betriebsgeheimnisse', 'Vergütungspflicht', 'Fürsorgepflicht', 'Pflicht zur Ausstellung eines Zeugnisses'], r: 0, e: 'Arbeitnehmer: Arbeitspflicht, Treuepflicht (z. B. Verschwiegenheit, Wettbewerbsverbot). Arbeitgeber: Vergütungspflicht, Fürsorgepflicht, Zeugnispflicht, Beschäftigungspflicht.' },
        { t: 'Wirtschaft', f: 'Ein Systemhaus will einen festen Umsatz mit möglichst geringem Personaleinsatz erzielen. Nach welchem Prinzip handelt es?', o: ['Minimalprinzip', 'Maximalprinzip', 'Solidaritätsprinzip', 'Subsidiaritätsprinzip'], r: 0, e: 'Ökonomisches Prinzip: Minimalprinzip = ein gegebenes Ziel mit möglichst geringem Mitteleinsatz; Maximalprinzip = mit gegebenen Mitteln ein möglichst großes Ergebnis.' },
        { t: 'Wirtschaft', f: 'Auf einem Markt stehen wenige große Anbieter vielen Nachfragern gegenüber (z. B. Mobilfunknetze). Welche Marktform ist das?', o: ['Angebotsoligopol', 'Polypol', 'Angebotsmonopol', 'Nachfragemonopol'], r: 0, e: 'Wenige Anbieter, viele Nachfrager: Angebotsoligopol. Ein Anbieter: Monopol. Viele Anbieter und viele Nachfrager: Polypol.' },
        { t: 'Wirtschaft', f: 'Was passiert im Marktmodell, wenn die Nachfrage nach Grafikkarten bei gleichem Angebot stark steigt?', o: ['Der Gleichgewichtspreis steigt.', 'Der Gleichgewichtspreis sinkt.', 'Der Preis bleibt gleich, nur die Menge steigt.', 'Das Angebot sinkt automatisch.'], r: 0, e: 'Steigt die Nachfrage bei unverändertem Angebot, verschiebt sich die Nachfragekurve nach rechts: Gleichgewichtspreis und -menge steigen.' },
        { t: 'Lohn & Steuern', f: 'Eine alleinerziehende Mitarbeiterin mit einem Kind fragt nach ihrer Lohnsteuerklasse.', o: ['Steuerklasse II', 'Steuerklasse I', 'Steuerklasse III', 'Steuerklasse V'], r: 0, e: 'Klasse I: ledig; II: alleinerziehend (Entlastungsbetrag); III/V oder IV/IV: verheiratet; VI: zweites und jedes weitere Arbeitsverhältnis.' },
        { t: 'Lohn & Steuern', f: 'Was wird vom Bruttogehalt NICHT abgezogen?', o: ['der Arbeitgeberanteil zur Rentenversicherung', 'die Lohnsteuer', 'der Arbeitnehmeranteil zur Krankenversicherung', 'gegebenenfalls die Kirchensteuer'], r: 0, e: 'Netto = Brutto − Lohnsteuer − Solidaritätszuschlag (falls fällig) − Kirchensteuer − Arbeitnehmeranteile zur Sozialversicherung. Den Arbeitgeberanteil zahlt der Arbeitgeber zusätzlich.' },
        { t: 'Mutterschutz & Elternzeit', f: 'Wie lange darf eine Mitarbeiterin nach der Geburt ihres Kindes im Regelfall nicht beschäftigt werden?', o: ['8 Wochen', '6 Wochen', '12 Wochen', '4 Wochen'], r: 0, e: 'MuSchG § 3: Schutzfrist sechs Wochen vor und acht Wochen nach der Entbindung (bei Früh- oder Mehrlingsgeburten zwölf Wochen nach der Geburt).' },
        { t: 'Mutterschutz & Elternzeit', f: 'Ein Vater möchte direkt nach der Geburt Elternzeit nehmen. Wie lange vorher muss er sie spätestens schriftlich verlangen?', o: ['7 Wochen', '4 Wochen', '3 Monate', 'gar nicht, er kann sofort zu Hause bleiben'], r: 0, e: 'Elternzeit muss für die Zeit bis zum dritten Geburtstag spätestens sieben Wochen vor Beginn schriftlich verlangt werden (§ 16 BEEG). Insgesamt sind bis zu drei Jahre pro Kind möglich.' }
    ];

    const naechsterFall = deck(FAELLE);

    function fallAufgabe(rng) {
        const fall = naechsterFall(rng);
        const reihenfolge = rng.shuffle(fall.o.map((text, i) => ({ text, richtig: i === fall.r })));
        const name = 'fall-' + Math.random().toString(36).slice(2, 8);
        const optionen = [];
        return {
            title: fall.t,
            description: 'Wähle die zutreffende Antwort.',
            hint: 'Lies genau, wer handelt (Arbeitgeber oder Arbeitnehmer, Azubi oder Fachkraft, Verbraucher oder Unternehmen) – davon hängt die Regel oft ab.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question' }, fall.f));
                const liste = h('div', { class: 'game-choices', role: 'radiogroup', 'aria-label': 'Antworten' });
                reihenfolge.forEach((opt, i) => {
                    const input = h('input', { type: 'radio', name, class: 'form-check-input', value: i });
                    const label = h('label', { class: 'game-choice' }, input, h('span', {}, opt.text));
                    optionen.push({ input, label, opt });
                    liste.append(label);
                });
                body.append(liste);
            },
            check() {
                const gewaehlt = optionen.find((o) => o.input.checked);
                optionen.forEach((o) => o.label.classList.remove('is-valid', 'is-invalid'));
                if (!gewaehlt) return { correct: false, score: 0, message: 'Bitte eine Antwort auswählen.' };
                gewaehlt.label.classList.add(gewaehlt.opt.richtig ? 'is-valid' : 'is-invalid');
                return { correct: gewaehlt.opt.richtig, score: gewaehlt.opt.richtig ? 1 : 0, message: gewaehlt.opt.richtig ? fall.e : 'Überleg noch einmal – oder lass dir die Lösung zeigen.' };
            },
            showSolution(box) {
                optionen.forEach((o) => {
                    o.label.classList.toggle('is-valid', o.opt.richtig);
                    o.label.classList.remove('is-invalid');
                    o.input.checked = o.opt.richtig;
                });
                box.append(h('h3', {}, 'Erklärung'), h('p', { class: 'mb-0' }, fall.e));
            }
        };
    }

    // ---------- Zahlen und Fristen ----------

    const FAKTEN = [
        { f: 'Höchstdauer der Probezeit in der Ausbildung', a: 4, e: 'Monate' },
        { f: 'Mindestdauer der Probezeit in der Ausbildung', a: 1, e: 'Monat(e)' },
        { f: 'Gesetzlicher Mindesturlaub nach BUrlG (6-Tage-Woche)', a: 24, e: 'Werktage' },
        { f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 16 sind', a: 30, e: 'Werktage' },
        { f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 17 sind', a: 27, e: 'Werktage' },
        { f: 'Urlaub für Jugendliche, die zu Jahresbeginn noch nicht 18 sind', a: 25, e: 'Werktage' },
        { f: 'Mindestzahl ständiger wahlberechtigter Arbeitnehmer für einen Betriebsrat', a: 5, e: 'Arbeitnehmer' },
        { f: 'Mindestalter für das Wahlrecht bei der Betriebsratswahl', a: 16, e: 'Jahre' },
        { f: 'Mutterschutzfrist vor der Entbindung', a: 6, e: 'Wochen' },
        { f: 'Mutterschutzfrist nach der Entbindung (Regelfall)', a: 8, e: 'Wochen' },
        { f: 'Entgeltfortzahlung im Krankheitsfall durch den Arbeitgeber', a: 6, e: 'Wochen' },
        { f: 'Gesetzliche Mängelhaftung beim Kauf neuer Sachen', a: 2, e: 'Jahre' },
        { f: 'Widerrufsfrist bei Online-Käufen für Verbraucher', a: 14, e: 'Tage' },
        { f: 'Regelmäßige Verjährungsfrist', a: 3, e: 'Jahre' },
        { f: 'Mindeststammkapital einer GmbH', a: 25000, e: '€' },
        { f: 'Mindestgrundkapital einer AG', a: 50000, e: '€' },
        { f: 'Kündigungsschutzgesetz: Betriebsgröße „mehr als …“', a: 10, e: 'Arbeitnehmer' },
        { f: 'Kündigungsschutzgesetz: Wartezeit', a: 6, e: 'Monate' },
        { f: 'Höchstarbeitszeit für Jugendliche pro Woche', a: 40, e: 'Stunden' },
        { f: 'Mindestruhezeit zwischen zwei Arbeitstagen (Erwachsene)', a: 11, e: 'Stunden' },
        { f: 'Pause bei mehr als 6 Stunden Arbeit (Erwachsene)', a: 30, e: 'Minuten' },
        { f: 'Pause bei mehr als 9 Stunden Arbeit (Erwachsene)', a: 45, e: 'Minuten' },
        { f: 'Pause bei mehr als 6 Stunden Arbeit (Jugendliche)', a: 60, e: 'Minuten' },
        { f: 'Maximale Elternzeit je Kind', a: 3, e: 'Jahre' },
        { f: 'Grundkündigungsfrist nach § 622 Abs. 1 BGB', a: 4, e: 'Wochen' },
        { f: 'Kündigungsfrist während einer vereinbarten Probezeit im Arbeitsverhältnis', a: 2, e: 'Wochen' },
        { f: 'Längste Probezeit mit verkürzter Kündigungsfrist im Arbeitsverhältnis', a: 6, e: 'Monate' },
        { f: 'Widerspruchsfrist gegen einen Mahnbescheid', a: 2, e: 'Wochen' },
        { f: 'Beweislastumkehr beim Verbrauchsgüterkauf', a: 1, e: 'Jahr(e)' },
        { f: 'Anmeldefrist für Elternzeit (bis zum 3. Geburtstag) vor Beginn', a: 7, e: 'Wochen' }
    ];

    const naechstesFaktum = deck(FAKTEN);

    function faktenAufgabe(rng, level) {
        const auswahl = [];
        while (auswahl.length < 4) {
            const x = naechstesFaktum(rng);
            if (!auswahl.includes(x)) auswahl.push(x);
        }
        const fragen = auswahl.map((x) => ({ label: x.f, answer: x.a, unit: x.e }));
        // eine berechnete Verjährungsfrage
        const entstanden = zufallsDatum(rng, 2023, 2026);
        fragen.push({ label: `Eine Forderung entstand am ${de(entstanden)}. Die regelmäßige Verjährung endet mit Ablauf des 31.12. im Jahr …`, answer: entstanden.getUTCFullYear() + 3, unit: '', verj: entstanden });
        const felder = [];
        return {
            title: 'Zahlen und Fristen',
            description: 'Fünf schnelle Fragen – trage jeweils nur die Zahl ein.',
            hint: 'Merkhilfe: Probezeit Ausbildung 1–4 Monate, Verjährung 3 Jahre ab Jahresende, Gewährleistung 2 Jahre, Widerruf 14 Tage.',
            render(body) {
                fragen.forEach((q, i) => {
                    const id = 'wf-' + i;
                    const input = numberInput({ id, inputmode: 'numeric' });
                    felder.push({ input, answer: q.answer, q });
                    body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: id, style: 'flex:1 1 20rem' }, q.label), input, q.unit ? h('span', { class: 'game-unit', style: 'min-width:6rem' }, q.unit) : null));
                });
            },
            check() {
                const r = checkFields(felder);
                return { correct: r.correct, score: r.score, message: r.correct ? '' : `${r.right} von ${r.total} richtig.` };
            },
            showSolution(box) {
                felder.forEach((f) => { f.input.value = deFormat(f.answer, 0); mark(f.input, null); });
                const v = fragen[fragen.length - 1];
                box.append(h('h3', {}, 'Hinweis zur Verjährung'), h('p', { class: 'mb-0' },
                    `Entstanden ${de(v.verj)} → Fristbeginn mit Schluss des Jahres (31.12.${v.verj.getUTCFullYear()}) → plus 3 Jahre → Ablauf des 31.12.${v.answer}.`));
            }
        };
    }

    // ---------- Kündigungsfristen ----------

    const VERLAENGERT = [[20, 7], [15, 6], [12, 5], [10, 4], [8, 3], [5, 2], [2, 1]];

    function kuendigungsAufgabe(rng, level) {
        const art = rng.pick(level === 1 ? ['grund-an', 'grund-ag'] : level === 2 ? ['grund-an', 'lang', 'lang', 'probe'] : ['lang-eintritt', 'lang-eintritt', 'probe', 'grund-an']);
        const zugang = zufallsDatum(rng, 2025, 2027);
        let text;
        let ende;
        const schritte = [];
        if (art === 'probe') {
            const eintritt = plusMonate(zugang, -rng.int(1, 5));
            text = `Mia ist seit dem ${de(eintritt)} angestellt, vereinbart sind 6 Monate Probezeit. Der Arbeitgeber kündigt; die Kündigung geht ihr am <strong>${deLang(zugang)}</strong> zu.`;
            ende = plusTage(zugang, 14);
            schritte.push('Während einer vereinbarten Probezeit (höchstens 6 Monate) beträgt die Frist <strong>2 Wochen</strong> – ohne festen Endtermin (§ 622 Abs. 3 BGB).',
                `Die Frist beginnt am Tag nach dem Zugang und endet zwei Wochen später am gleichen Wochentag: <strong>${deLang(ende)}</strong>.`);
        } else if (art === 'grund-an' || art === 'grund-ag') {
            const jahre = art === 'grund-ag' ? rng.int(0, 1) : rng.int(1, 15);
            text = art === 'grund-an'
                ? `Jonas arbeitet seit ${jahre} Jahr${jahre === 1 ? '' : 'en'} in einem Systemhaus. Im Arbeitsvertrag ist nur die gesetzliche Frist vereinbart. Er kündigt selbst; die Kündigung geht dem Arbeitgeber am <strong>${deLang(zugang)}</strong> zu.`
                : `Ein Arbeitgeber kündigt einer Mitarbeiterin, die seit ${jahre === 0 ? 'zehn Monaten' : 'einem Jahr und drei Monaten'} im Betrieb ist (keine Probezeit mehr). Die Kündigung geht am <strong>${deLang(zugang)}</strong> zu.`;
            const frist = plusTage(zugang, 28);
            ende = frist.getUTCDate() <= 15 ? datum(frist.getUTCFullYear(), frist.getUTCMonth() + 1, 15) : monatsende(frist);
            if (art === 'grund-an') schritte.push('Kündigt der <strong>Arbeitnehmer</strong>, gilt die Grundkündigungsfrist – die verlängerten Fristen gelten nur für Kündigungen durch den Arbeitgeber.');
            else schritte.push('Weniger als 2 Jahre Betriebszugehörigkeit: Es gilt die Grundkündigungsfrist.');
            schritte.push('Grundkündigungsfrist: <strong>4 Wochen zum 15. oder zum Ende eines Kalendermonats</strong> (§ 622 Abs. 1 BGB).',
                `Vier Wochen nach dem Zugang: ${deLang(frist)} – frühestens dann darf das Arbeitsverhältnis enden.`,
                `Nächster zulässiger Termin (15. oder Monatsende): <strong>${deLang(ende)}</strong>.`);
        } else {
            let jahre;
            let zeile;
            if (art === 'lang-eintritt') {
                const eintritt = datum(zugang.getUTCFullYear() - rng.int(2, 22), rng.int(1, 12), 1 + rng.int(0, 27));
                jahre = volleJahre(eintritt, zugang);
                zeile = `Herr Kaya ist seit dem <strong>${de(eintritt)}</strong> im Unternehmen.`;
                schritte.push(`Betriebszugehörigkeit beim Zugang der Kündigung: ${de(eintritt)} bis ${de(zugang)} = <strong>${jahre} volle Jahre</strong>.`);
            } else {
                jahre = rng.int(2, 22);
                zeile = `Herr Kaya ist seit <strong>${jahre} Jahren</strong> im Unternehmen.`;
            }
            const stufe = VERLAENGERT.find(([j]) => jahre >= j);
            if (!stufe) return kuendigungsAufgabe(rng, level);
            const monate = stufe[1];
            text = `${zeile} Der Arbeitgeber kündigt ordentlich; die Kündigung geht am <strong>${deLang(zugang)}</strong> zu. Vertraglich gelten die gesetzlichen Fristen.`;
            const frist = plusMonate(zugang, monate);
            ende = monatsende(frist);
            schritte.push(`Kündigung durch den Arbeitgeber nach ${jahre} Jahren: verlängerte Frist von <strong>${monate} Monat${monate === 1 ? '' : 'en'} zum Monatsende</strong> (§ 622 Abs. 2 BGB, ab ${stufe[0]} Jahren).`,
                `${monate} Monat${monate === 1 ? '' : 'e'} nach dem Zugang: ${deLang(frist)}.`,
                `Nächstes Monatsende: <strong>${deLang(ende)}</strong>.`);
        }
        let feld;
        return {
            title: 'Kündigungsfrist berechnen',
            description: 'An welchem Tag endet das Arbeitsverhältnis frühestens? Feiertage und Wochenenden spielen dabei keine Rolle.',
            hint: '§ 622 BGB: Grundfrist 4 Wochen zum 15. oder Monatsende. Arbeitgeber ab 2 Jahren Betriebszugehörigkeit: 1 Monat, ab 5 J.: 2, ab 8 J.: 3, ab 10 J.: 4, ab 12 J.: 5, ab 15 J.: 6, ab 20 J.: 7 Monate – jeweils zum Monatsende. Probezeit: 2 Wochen.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html: text }));
                feld = h('input', { type: 'date', id: 'wk-ende', class: 'form-control form-control-sm game-num', style: 'max-width:12rem' });
                body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'wk-ende' }, 'Letzter Tag des Arbeitsverhältnisses'), feld));
            },
            check() {
                if (!feld.value) return { correct: false, score: 0, message: 'Bitte ein Datum eingeben.' };
                const ok = feld.value === iso(ende);
                mark(feld, ok);
                return { correct: ok, score: ok ? 1 : 0, message: ok ? `Das Arbeitsverhältnis endet am ${deLang(ende)}.` : '' };
            },
            showSolution(box) {
                feld.value = iso(ende);
                mark(feld, null);
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, schritte.map((s) => h('li', { html: s }))));
            }
        };
    }

    // ---------- Urlaubsanspruch ----------

    function urlaubsAufgabe(rng, level) {
        const jahr = rng.int(2025, 2028);
        if (level === 3) {
            const jahresurlaub = rng.pick([24, 25, 26, 28, 30]);
            const kandidaten = [];
            for (let m = 2; m <= 12; m++) {
                const monate = 13 - m;
                const rest = (jahresurlaub * monate) % 12;
                if (m <= 7 || rest === 0 || rest >= 6) kandidaten.push(m);
            }
            const m = rng.pick(kandidaten);
            const eintritt = datum(jahr, m, 1);
            const voll = m <= 7;
            const monate = 13 - m;
            const roh = jahresurlaub * monate / 12;
            const anspruch = voll ? jahresurlaub : (roh % 1 === 0 ? roh : Math.ceil(roh));
            const wartezeitEnde = plusTage(plusMonate(eintritt, 6), -1);
            return einfacheUrlaubsAufgabe({
                text: `Sophie beginnt am <strong>${de(eintritt)}</strong> bei einem neuen Arbeitgeber (5-Tage-Woche). Laut Vertrag hat sie <strong>${jahresurlaub} Arbeitstage</strong> Urlaub im Jahr; für das Eintrittsjahr regelt der Vertrag nichts Besonderes. Wie viele Urlaubstage stehen ihr für ${jahr} zu?`,
                answer: anspruch,
                unit: 'Arbeitstage',
                schritte: [
                    `Der volle Urlaubsanspruch entsteht erst nach sechs Monaten Wartezeit (§ 4 BUrlG): ${de(eintritt)} bis ${de(wartezeitEnde)}.`,
                    voll ? `Die Wartezeit endet noch ${jahr} → voller Jahresurlaub: <strong>${anspruch} Tage</strong>.`
                        : `Die Wartezeit endet erst ${wartezeitEnde.getUTCFullYear()} → für ${jahr} nur Teilurlaub: 1/12 je vollem Monat (§ 5 BUrlG).`,
                    voll ? 'Häufiger Fehler: anteilig rechnen, obwohl die Wartezeit im selben Jahr erfüllt wird.'
                        : `${jahresurlaub} · ${monate}/12 = ${deFormat(roh, 2)}` + (roh % 1 === 0 ? '' : ' → Bruchteile ab einem halben Tag werden aufgerundet') + ` → <strong>${anspruch} Tage</strong>.`
                ]
            });
        }
        const alterZuJahresbeginn = rng.pick(level === 1 ? [14, 15, 16, 17, 18, 21] : [15, 16, 17, 19, 25]);
        const geburt = datum(jahr - alterZuJahresbeginn - 1, rng.int(1, 12), 2 + rng.int(0, 26));
        const werktage = alterZuJahresbeginn < 16 ? 30 : alterZuJahresbeginn < 17 ? 27 : alterZuJahresbeginn < 18 ? 25 : 24;
        const gesetz = alterZuJahresbeginn < 18 ? 'JArbSchG § 19' : 'BUrlG § 3';
        if (level === 1) {
            return einfacheUrlaubsAufgabe({
                text: `Ein Azubi wurde am <strong>${de(geburt)}</strong> geboren. Wie viele Werktage gesetzlichen Mindesturlaub hat er im Jahr <strong>${jahr}</strong> (6-Tage-Woche)?`,
                answer: werktage,
                unit: 'Werktage',
                schritte: [
                    `Maßgeblich ist das Alter zu Beginn des Kalenderjahres: Am 01.01.${jahr} ist er ${alterZuJahresbeginn} Jahre alt.`,
                    alterZuJahresbeginn < 18 ? 'JArbSchG § 19: noch nicht 16 → 30, noch nicht 17 → 27, noch nicht 18 → 25 Werktage.' : 'Volljährig: Mindesturlaub nach BUrlG 24 Werktage.',
                    `Ergebnis: <strong>${werktage} Werktage</strong> (${gesetz}).`
                ]
            });
        }
        const tage = rng.pick([4, 5, 5]);
        const arbeitstage = werktage * tage / 6;
        return einfacheUrlaubsAufgabe({
            text: `Geburtsdatum <strong>${de(geburt)}</strong>, Jahr <strong>${jahr}</strong>. Gearbeitet wird an <strong>${tage} Tagen pro Woche</strong>. Wie viele Arbeitstage beträgt der gesetzliche Mindesturlaub?`,
            answer: Math.round(arbeitstage * 100) / 100,
            decimals: 2,
            unit: 'Arbeitstage',
            schritte: [
                `Alter am 01.01.${jahr}: ${alterZuJahresbeginn} Jahre → <strong>${werktage} Werktage</strong> (${gesetz}).`,
                `Werktage beziehen sich auf eine 6-Tage-Woche (Mo–Sa). Umrechnung: ${werktage} · ${tage} / 6 = <strong>${deFormat(arbeitstage, 2)} Arbeitstage</strong>.`,
                arbeitstage % 1 ? 'Bruchteile werden beim vollen Jahresurlaub nicht gerundet – sie werden stundenweise gewährt.' : 'Das Ergebnis ist eine ganze Zahl.'
            ]
        });
    }

    function einfacheUrlaubsAufgabe(cfg) {
        let input;
        return {
            title: 'Urlaubsanspruch',
            description: 'Gesetzlicher bzw. vertraglicher Urlaub nach BUrlG und JArbSchG.',
            hint: 'Jugendliche: Alter zu Beginn des Kalenderjahres zählt. Werktage = 6-Tage-Woche, Umrechnung: Werktage · Arbeitstage pro Woche / 6. Voller Anspruch erst nach 6 Monaten Wartezeit.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html: cfg.text }));
                input = numberInput({ id: 'wu-tage' });
                body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'wu-tage' }, 'Urlaubsanspruch'), input, h('span', { class: 'game-unit' }, cfg.unit)));
            },
            check() {
                const r = checkFields([{ input, answer: cfg.answer, tolerance: cfg.decimals ? 0.01 : 0 }]);
                return { correct: r.correct, score: r.score, message: '' };
            },
            showSolution(box) {
                input.value = deFormat(cfg.answer, cfg.decimals || 0);
                mark(input, null);
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, cfg.schritte.map((s) => h('li', { html: s }))));
            }
        };
    }

    // ---------- Sozialversicherung ----------

    function svAufgabe(rng, level) {
        const brutto = rng.int(22, 55) * 100 + rng.pick([0, 25, 50, 80]);
        const zusatz = rng.pick([2.5, 2.7, 2.9, 3.1]);
        const kinderlos = rng.chance(0.5);
        const saetze = {
            kv: { name: 'Krankenversicherung', gesamt: 14.6 + zusatz, an: (14.6 + zusatz) / 2, info: `14,6 % + ${deFormat(zusatz, 1)} % Zusatzbeitrag, je zur Hälfte` },
            pv: { name: 'Pflegeversicherung', gesamt: 3.6, an: 1.8 + (kinderlos ? 0.6 : 0), info: '3,6 %, je zur Hälfte' + (kinderlos ? '; Kinderlosenzuschlag 0,6 % trägt der Arbeitnehmer allein' : '') },
            rv: { name: 'Rentenversicherung', gesamt: 18.6, an: 9.3, info: '18,6 %, je zur Hälfte' },
            av: { name: 'Arbeitslosenversicherung', gesamt: 2.6, an: 1.3, info: '2,6 %, je zur Hälfte' }
        };
        const zweige = level === 1 ? ['rv', 'av'] : ['kv', 'pv', 'rv', 'av'];
        const betraege = zweige.map((k) => ({ k, betrag: r2(brutto * saetze[k].an / 100) }));
        const summe = r2(betraege.reduce((s, b) => s + b.betrag, 0));
        const lohnsteuer = level === 3 ? r2(brutto * rng.pick([0.08, 0.1, 0.12, 0.14])) : 0;
        const kistSatz = level === 3 ? rng.pick([0, 8, 9]) : 0;
        const kist = r2(lohnsteuer * kistSatz / 100);
        const netto = r2(brutto - summe - lohnsteuer - kist);
        const felder = betraege.map((b) => ({ label: `AN-Anteil ${saetze[b.k].name}`, answer: b.betrag }));
        felder.push({ label: 'AN-Anteile gesamt', answer: summe });
        if (level === 3) felder.push({ label: 'Nettogehalt', answer: netto });
        const inputs = [];
        return {
            title: 'Sozialversicherungsbeiträge',
            description: 'Rechne mit den angegebenen Beitragssätzen (Beispielwerte, Bruttogehalt unter den Beitragsbemessungsgrenzen). Jeden Beitrag auf Cent runden.',
            hint: 'Arbeitnehmeranteil = Brutto · halber Beitragssatz. Ausnahmen: Zusatzbeitrag der KV wird ebenfalls geteilt, der Kinderlosenzuschlag zur Pflegeversicherung nicht.',
            render(body) {
                body.append(h('div', { class: 'game-scenario game-question', html:
                    `Bruttogehalt: <strong>${eur(brutto)}</strong> im Monat, ${kinderlos ? 'kinderlos, 27 Jahre' : 'ein Kind'}.<br>` +
                    zweige.map((k) => `${saetze[k].name}: ${saetze[k].info}`).join('<br>') +
                    (level === 3 ? `<br>Lohnsteuer laut Tabelle: <strong>${eur(lohnsteuer)}</strong>, Kirchensteuer: ${kistSatz ? kistSatz + ' % der Lohnsteuer' : 'keine (kein Kirchenmitglied)'}, kein Solidaritätszuschlag.` : '') }));
                felder.forEach((f, i) => {
                    const input = numberInput({ id: 'sv-' + i });
                    inputs.push({ input, answer: f.answer, tolerance: 0.011 });
                    body.append(h('div', { class: 'game-fieldrow' }, h('label', { for: 'sv-' + i }, f.label), input, h('span', { class: 'game-unit' }, '€')));
                });
            },
            check() {
                const r = checkFields(inputs);
                return { correct: r.correct, score: r.score, message: r.correct ? (level === 1 ? 'Die übrigen Zweige (KV, PV) folgen auf Stufe Mittel.' : '') : '' };
            },
            showSolution(box) {
                inputs.forEach((f) => { f.input.value = deFormat(f.answer, 2); mark(f.input, null); });
                const schritte = betraege.map((b) => `${saetze[b.k].name}: ${eur(brutto)} · ${deFormat(saetze[b.k].an, 2)} % = <strong>${eur(b.betrag)}</strong>`);
                schritte.push(`Summe Arbeitnehmeranteile: <strong>${eur(summe)}</strong>`);
                if (level === 3) {
                    if (kistSatz) schritte.push(`Kirchensteuer: ${eur(lohnsteuer)} · ${kistSatz} % = ${eur(kist)}`);
                    schritte.push(`Netto: ${eur(brutto)} − ${eur(summe)} − ${eur(lohnsteuer)}${kistSatz ? ' − ' + eur(kist) : ''} = <strong>${eur(netto)}</strong>`);
                }
                schritte.push('Die Unfallversicherung zahlt der Arbeitgeber allein – sie taucht in der Gehaltsabrechnung nicht als Abzug auf.');
                box.append(h('h3', {}, 'Lösungsweg'), h('ol', { class: 'game-steps' }, schritte.map((s) => h('li', { html: s }))));
            }
        };
    }

    const modes = [
        { id: 'faelle', name: 'Fallentscheidungen', icon: 'bi-briefcase', levels: false, description: 'Kurze Fälle aus Ausbildung, Arbeitsrecht, Kaufvertrag und Wirtschaft.', create: ({ rng }) => fallAufgabe(rng) },
        { id: 'fakten', name: 'Zahlen & Fristen', icon: 'bi-stopwatch', levels: false, create: ({ rng, level }) => faktenAufgabe(rng, level) },
        { id: 'kuendigung', name: 'Kündigungsfristen', icon: 'bi-calendar-x', create: ({ rng, level }) => kuendigungsAufgabe(rng, level) },
        { id: 'urlaub', name: 'Urlaubsanspruch', icon: 'bi-sun', create: ({ rng, level }) => urlaubsAufgabe(rng, level) },
        { id: 'sv', name: 'Sozialversicherung', icon: 'bi-shield-plus', create: ({ rng, level }) => svAufgabe(rng, level) }
    ];

    window.WisoTrainer = { modes, FAELLE, FAKTEN, plusMonate, monatsende, plusTage, datum };

    const root = document.getElementById('wiso-game');
    if (root) window.ITGame.mount(root, { id: 'wiso', modes });
})();
